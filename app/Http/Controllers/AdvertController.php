<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Category;
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
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $query = Advert::with('user', 'region', 'city', 'category')
            ->where('moderation_status', Advert::MOD_ADVERT_APPROVED)
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now());

        if ($request->filled('category_id')) {
            $category = Category::query()
                ->where('id', $request->category_id)
                ->where('is_active', true)
                ->first();
            if ($category) {
                $categoryIds = [$category->id];
                $childIds = $category->children()
                    ->where('is_active', true)
                    ->pluck('id')
                    ->all();
                if ($childIds !== []) {
                    $categoryIds = array_merge($categoryIds, $childIds);
                }
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%')
                    ->orWhere('external_links', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $categoryRoots = $this->categoryRoots();

        $adverts = $query->latest()->paginate(12)->withQueryString();

        $regions = Region::orderBy('name')->get();

        $cities = collect();
        if ($request->filled('region_id')) {
            $cities = City::where('region_id', $request->region_id)->orderBy('name')->get();
        }

        return view('adverts.index', compact('adverts', 'regions', 'cities', 'categoryRoots'));
    }

    /**
     * Корневые активные категории с дочерними (для фильтра и форм).
     */
    protected function categoryRoots(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->with([
                'children' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('name'),
            ])
            ->get();
    }

    public function create()
    {
        $regions = Region::orderBy('name')->get();
        $categoryRoots = $this->categoryRoots();

        return view('adverts.add-new-advert', compact('regions', 'categoryRoots'));
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
            'external_links' => 'nullable|string|max:5000',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Advert::create([
            'user_id' => auth()->id(),
            'slug' => Advert::uniqueSlugFromTitle($request->title),
            'title' => $request->title,
            'content' => $request->content,
            'external_links' => $request->external_links,
            'moderation_status' => Advert::MOD_ADVERT_PENDING,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
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
        $categoryRoots = $this->categoryRoots();

        return view('adverts.edit', compact('advert', 'regions', 'categoryRoots'));
    }

    public function update(Request $request, Advert $advert)
    {
        abort_if($advert->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'external_links' => 'nullable|string|max:5000',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $advert->update([
            'slug' => Advert::uniqueSlugFromTitle($request->title, $advert->id),
            'title' => $request->title,
            'content' => $request->content,
            'external_links' => $request->external_links,
            'moderation_status' => Advert::MOD_ADVERT_PENDING,
            'admin_comment' => null,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
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
