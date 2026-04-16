<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DealController extends Controller
{
    public function store(Request $request, Project $project)
    {
        abort_if((int) $project->user_id !== (int) auth()->id(), 403);

        if ($project->deal()->exists()) {
            return redirect()
                ->to($this->projectShowUrl($request, $project))
                ->with('error', 'Договор по этому проекту уже запрошен.');
        }

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
            DB::transaction(function () use ($project, $offer) {
                Deal::create([
                    'project_id' => $project->id,
                    'offer_id' => $offer->id,
                    'client_id' => $project->user_id,
                    'contractor_id' => $offer->user_id,
                    'price' => $offer->price,
                    'duration' => $offer->duration,
                    'status' => 'pending',
                ]);
            });
        } catch (\Illuminate\Database\QueryException $e){
            return back()->with('error', 'Сделка уже существует.');
        }


        return redirect()
            ->to($this->projectShowUrl($request, $project))
            ->with('success', 'Запрос договора отправлен исполнителю.');
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

    public function startTheDeal(Request $request)
    {
        $deals = Deal::all();
        return view('dashboard.my-deals', compact('deals'));
    }
}
