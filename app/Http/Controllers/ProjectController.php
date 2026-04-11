<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Region;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Project::query()
            ->where('moderation_status', Project::MOD_PROJECT_APPROVED);

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
            'moderation_status' => Project::MOD_PROJECT_PENDING,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
        ]);

        return redirect()->back()->with('success', 'Ваш Проект отправлен на модерацию!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);
        $regions = Region::all();

        return view('projects.edit', compact('project', 'regions'));
    }

    public function update(Request $request, Project $project)
    {
        abort_if($project->user_id !== auth()->id(), 403);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'moderation_status' => Project::MOD_PROJECT_PENDING,
            'admin_comment' => null,
            'expires_at' => now()->addDays(10),
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
        ]);

        return back()->with('success', 'Исправлено и отправлено на повторную проверку');
    }


}
