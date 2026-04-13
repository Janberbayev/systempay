<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'comments' => 'nullable|string|max:1000',
            'project_id' => 'required|exists:projects,id',
        ]);

        Offer::firstOrCreate([
            'user_id'       => auth()->id(),
            'project_id'    => $request->project_id,
            ], [
            'price'         => $request->price,
            'duration'      => $request->duration,
            'comments'      => $request->comments,
        ]);
        return redirect()->back()->with('success', 'Ваше предложение отправлено!');
    }
}
