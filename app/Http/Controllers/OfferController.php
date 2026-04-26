<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request, Project $project)
    {
        abort_if((int) $project->user_id === (int) auth()->id(), 403);

        $request->validate([
            'price' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'comments' => 'nullable|string|max:1000',
        ]);

        Offer::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'project_id' => $project->id,
            ],
            [
                'price' => $request->price,
                'duration' => $request->duration,
                'comments' => $request->comments,
            ]
        );

        return redirect()
            ->to($this->projectShowUrl($request, $project))
            ->with('success', 'Ваше предложение отправлено!');
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
}
