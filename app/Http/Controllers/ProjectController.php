<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Region;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $query = Project::query()
            ->with('category')
            ->where('moderation_status', Project::MOD_PROJECT_APPROVED)
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
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $projects = $query->latest()->paginate(12)->withQueryString();

        $regions = Region::orderBy('name')->get();

        $cities = collect();
        if ($request->filled('region_id')) {
            $cities = City::where('region_id', $request->region_id)->orderBy('name')->get();
        }

        $categoryRoots = $this->categoryRoots();

        return view('projects.index', compact('projects', 'regions', 'cities', 'categoryRoots'));
    }

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

        return view('projects.add-new-project', compact('regions', 'categoryRoots'));
    }

    public function store(Request $request)
    {
        //        вариант 1
        //        Project::create($request->all());

        //        вариант 2
        //        $data = $request->validate([
        // //            'user_id' => 'exists:users,id',
        //            'title' => 'required|string|max:255',
        //            'description' => 'required|string',
        //        ]);
        //        $request->user()->projects()->create($data);

        $request->validate([
            //            'user_id' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'moderation_status' => Project::MOD_PROJECT_PENDING,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Ваш Проект отправлен на модерацию!');
    }

    public function show(Project $project)
    {
        $hasOffer = Offer::where('project_id', $project->id)
            ->where('user_id', auth()->id())
            ->exists();

        $offer = Offer::where('project_id', $project->id)
            ->where('user_id', auth()->id())
            ->first();

        $offers = collect();
        if (auth()->check() && (int) $project->user_id === (int) auth()->id()) {
            $project->loadMissing('deal');
            $offers = $project->offers()->with('user')->latest()->get();
        }

        return view('projects.show', compact('project', 'hasOffer', 'offer', 'offers'));
    }

    public function edit(Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);
        $regions = Region::all();
        $categoryRoots = $this->categoryRoots();

        return view('projects.edit', compact('project', 'regions', 'categoryRoots'));
    }

    public function update(Request $request, Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'moderation_status' => Project::MOD_PROJECT_PENDING,
            'admin_comment' => null,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
        ]);

        return back()->with('success', 'Исправлено и отправлено на повторную проверку');
    }
}
