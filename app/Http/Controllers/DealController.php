<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Offer;
use App\Models\Project;
use App\Services\ContractDocxGenerator;
use App\Services\ContractService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DealController extends Controller
{
    public function store(Request $request, Project $project, ContractService $contractService)
    {
        abort_if((int) $project->user_id !== (int) auth()->id(), 403);

        $request->validate([
            'selected_offer_id' => [
                'required',
                Rule::exists('offers', 'id')->where(fn ($q) => $q->where('project_id', $project->id)),
            ],
        ]);

        $offerId = $request->input('selected_offer_id');

        $offer = Offer::where('project_id', $project->id)
            ->whereKey($offerId)  // это сокращение от: ->where('id', $offerId)
            ->firstOrFail();      // если нашли → возвращает offer. если не нашли → кидает 404 ошибку

        try {
            $wasNew = DB::transaction(function () use ($project, $offer, $contractService) {
                Project::whereKey($project->id)->lockForUpdate()->firstOrFail();

                $deal = Deal::where('project_id', $project->id)->first();

                if ($deal !== null) {
                    if ((int) $deal->offer_id !== (int) $offer->id) {
                        throw new DomainException('offer_mismatch');
                    }

                    if ($deal->contractVersions()->doesntExist()) {
                        $deal->loadMissing(['project.region', 'project.city', 'client', 'contractor', 'offer']);
                        $contractService->createVersion($deal, $this->buildContractSnapshot($deal));
                    }

                    return false;
                }

                $deal = Deal::create([
                    'project_id' => $project->id,
                    'offer_id' => $offer->id,
                    'client_id' => $project->user_id,
                    'contractor_id' => $offer->user_id,
                    'price' => $offer->price,
                    'duration' => $offer->duration,
                    'status' => Deal::STATUS_CONTRACT_REVIEW,
                ]);

                $deal->loadMissing(['project.region', 'project.city', 'client', 'contractor', 'offer']);
                $contractService->createVersion($deal, $this->buildContractSnapshot($deal));

                return true;
            });
        } catch (DomainException $e) {
            if ($e->getMessage() === 'offer_mismatch') {
                return redirect()
                    ->to($this->projectShowUrl($request, $project))
                    ->with('error', 'По этому проекту уже выбран другой исполнитель.');
            }

            throw $e;
        }

        $message = $wasNew
            ? 'Исполнитель выбран. Черновик договора сформирован и доступен в карточке сделки.'
            : 'Сделка по проекту уже оформлена. Черновик договора доступен в карточке сделки.';

        return redirect()
            ->to($this->projectShowUrl($request, $project))
            ->with('success', $message);
    }

    private function projectShowUrl(Request $request, Project $project): string
    {
        $query = [];
        if ($request->input('from') === 'dashboard') {
            $query['from'] = 'dashboard';
            $tab = $request->input('tab', 'on-site');
            $query['tab'] = in_array($tab, ['on-site', 'pending', 'archive'], true) ? $tab : 'on-site';
        } elseif ($request->input('from') === 'list') {
            $query['from'] = 'list';
        }

        $url = route('show-project', $project);
        if ($query !== []) {
            $url .= '?'.http_build_query($query);
        }

        return $url;
    }

    public function show(Request $request, Deal $deal)
    {
        $userId = (int) auth()->id();
        if ((int) $deal->client_id !== $userId && (int) $deal->contractor_id !== $userId) {
            abort(403);
        }

        $deal->load([
            'project.region',
            'project.city',
            'project.user',
            'offer.user',
            'client',
            'contractor',
        ]);

        $contractVersion = $deal->contractVersions()->orderByDesc('version')->first();

        return view('deals.show', compact('deal', 'contractVersion'));
    }

    public function downloadContractWord(Deal $deal, ContractDocxGenerator $docxGenerator)
    {
        $userId = (int) auth()->id();
        if ((int) $deal->client_id !== $userId && (int) $deal->contractor_id !== $userId) {
            abort(403);
        }

        $version = $deal->contractVersions()->orderByDesc('version')->first();
        abort_if($version === null, 404);

        $relative = $version->file_path;
        if ($relative === null || $relative === '' || ! Storage::disk('local')->exists($relative)) {
            $snapshot = is_array($version->snapshot) ? $version->snapshot : [];
            $relative = $docxGenerator->generate($deal, $snapshot, (int) $version->version);
            $version->update(['file_path' => $relative]);
        }

        $downloadName = 'dogovor-sdelka-'.$deal->id.'-v'.$version->version.'.docx';

        return Storage::disk('local')->download($relative, $downloadName);
    }

    private function buildContractSnapshot(Deal $deal): array
    {
        $project = $deal->project;
        $offer = $deal->offer;

        return [
            'schema_version' => 1,
            'deal_id' => $deal->id,
            'formed_at' => now()->toIso8601String(),
            'project' => [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'region' => $project->region->name ?? null,
                'city' => $project->city->name ?? null,
            ],
            'offer' => [
                'id' => $offer->id,
                'price' => (string) $offer->price,
                'duration' => $offer->duration,
                'comments' => $offer->comments,
            ],
            'client' => [
                'id' => $deal->client_id,
                'name' => $deal->client->name,
                'email' => $deal->client->email ?? null,
                'phone' => $deal->client->phone ?? null,
            ],
            'contractor' => [
                'id' => $deal->contractor_id,
                'name' => $deal->contractor->name,
                'email' => $deal->contractor->email ?? null,
                'phone' => $deal->contractor->phone ?? null,
            ],
        ];
    }
}
