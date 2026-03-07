<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Region;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Project::query();

        // Поиск
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->latest()->paginate(12);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $regions = Region::orderBy('name')->get();
        return view('projects.add-new-project', compact('regions'));
    }

    public function store(Request $request)
    {
//        вариант 1
//        Project::create($request->all());

//        вариант 2
//        $data = $request->validate([
////            'user_id' => 'exists:users,id',
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
        ]);

        Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => Project::MOD_PROJECT_PENDING,
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
        ]);

        return redirect()->back()->with('success', 'Ваш Проект отправлен на модерацию!');
    }
}
