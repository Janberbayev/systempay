<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        $query = Advert::with('user', 'region', 'city')
            ->where('moderation_status', Advert::MOD_ADVERT_APPROVED)
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $adverts = $query->latest()->paginate(12)->withQueryString();

        $regions = Region::orderBy('name')->get();

        $cities = collect();
        if ($request->filled('region_id')) {
            $cities = City::where('region_id', $request->region_id)->orderBy('name')->get();
        }

        return view('adverts.index', compact('adverts', 'regions', 'cities'));
    }

    public function create()
    {
        $regions = Region::orderBy('name')->get();

        return view('adverts.add-new-advert', compact('regions'));
    }

    public function store(Request $request)
    {
        // 1 вариант - Advert::create($request->all());

        // 2 вариант
        //        $data = $request->validate([
        // //            'user_id' => 'exists:users,id',
        //            'title' => 'required|string|max:255',
        //            'content' => 'required|string',
        //        ]);
        //        $request->user()->adverts()->create($data);

        // 3 вариант
        //        $request->user()->adverts()->create([
        //            'title' => $request->title,
        //            'content' => $request->content,
        //            'status' => 'pending',
        //        ]);

        // 4 вариант
        $request->validate([
            //            'user_id' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        Advert::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'moderation_status' => Advert::MOD_ADVERT_PENDING,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
        ]);

        return redirect()->back()->with('success', 'Объявление отправлено на модерацию.');
    }

    public function show(Advert $advert)
    {
        return view('adverts.show', compact('advert'));
    }

    public function edit(Advert $advert)
    {
        abort_if($advert->user_id !== auth()->id(), 403);
        $regions = Region::all();

        return view('adverts.edit', compact('advert', 'regions'));
    }

    public function update(Request $request, Advert $advert)
    {
        abort_if($advert->user_id !== auth()->id(), 403);

        $advert->update([
            'title' => $request->title,
            'content' => $request->content,
            'moderation_status' => Advert::MOD_ADVERT_PENDING,
            'admin_comment' => null,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
        ]);

        return back()->with('success', 'Исправлено и отправлено на повторную проверку');
    }

    /**
     * Удаление объявления пользователем‑создателем.
     */
    public function destroy(Advert $advert)
    {
        abort_if($advert->user_id !== auth()->id(), 403);

        $advert->delete();

        return redirect()->route('list-ads')->with('success', 'Объявление удалено.');
    }

    public function restore(Advert $advert)
    {
        abort_if($advert->user_id !== auth()->id(), 403);

        $advert->extend(10);

        return back()->with('success', 'Объявление продлено на 10 дней');
    }
}
