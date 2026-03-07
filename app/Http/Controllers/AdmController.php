<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Project;
use App\Models\User;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdmController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->where('name', '!=', 'admin')->get();

        $users = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'admin');
        })
            ->orderBy('created_at')
            ->get();

        // VERSION #1 - Get all Adverts that are not approved
        // Check for false or null values (null for posts created before migration)
//        $pendingAdverts = Advert::with('user')
//            ->where(function($query) {
//                $query->where('is_approved', false)
//                    ->orWhereNull('is_approved');
//            })
//            ->latest()
//            ->get();

        // VERSION #1 - Same for the projects
//        $pendingProjects = Project::with('user')
//            ->where(function($query) {
//                $query->where('is_approved', false)
//                    ->orWhereNull('is_approved');
//            })
//            ->latest()
//            ->get();

        // VERSION #2
//        $pendingAdverts = Advert::where('status', 'pending')->latest()->get();
//        $pendingProjects = Project::where('status', 'pending')->latest()->get();
        $adverts = Advert::all();
        $projects = Project::all();

        return view('admin.page', compact('roles', 'users', 'adverts', 'projects'));
    }

    public function adverts(Request $request)
    {
        $query = Advert::with('user', 'region', 'city');

        // Фильтр по поиску (название или содержание)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('moderation_status', $request->status);
        }

        // Фильтр по области
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        // Фильтр по городу
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Фильтр по дате от
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // Фильтр по дате до
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $adverts = $query->latest()->paginate(15)->withQueryString();

        // Получаем все регионы для селекта
        $regions = Region::orderBy('name')->get();

        // Получаем города выбранной области (если выбрана)
        $cities = collect();
        if ($request->filled('region_id')) {
            $cities = City::where('region_id', $request->region_id)->orderBy('name')->get();
        }

        return view('admin.adverts.index', compact('adverts', 'regions', 'cities'));
    }

    public function approveAdvert(Advert $advert)
    {
        // Только админ может одобрять Adverts
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }

//        $advert->update(['is_approved' => true]);
        $advert->update([
            'moderation_status' => Advert::MOD_ADVERT_APPROVED,
            'expires_at'        => now()->addDays(10),
            'admin_comment'     => null,
        ]);

        return redirect()->route('admin.adverts')->with('success', 'Объявление опубликовано на 10 дней!');
    }

    public function rejectAdvert(Request $request, Advert $advert)
    {
        // Только админ может отклонять Adverts
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }
//        $advert->delete();

        $request->validate([
            'comment' => 'required|string'
        ]);

        $advert->update([
            'moderation_status' => Advert::MOD_ADVERT_REJECTED,
            'admin_comment' => $request->comment,
        ]);

        return redirect()->route('admin.adverts')->with('success', 'Объявление отклонено');
    }

    public function revisionAdvert(Request $request, Advert $advert)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $advert->update([
            'moderation_status' => Advert::MOD_ADVERT_REVISION,
            'admin_comment' => $request->comment,
        ]);

        return redirect()->route('admin.adverts')->with('success', 'Отправлено на доработку');
    }


    public function projects(Request $request)
    {
        $query = Project::with('user', 'region', 'city');

        // Фильтр по поиску (название или содержание)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Фильтр по области
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        // Фильтр по городу
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Фильтр по дате от
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // Фильтр по дате до
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $projects = $query->latest()->paginate(15)->withQueryString();

        // Получаем все регионы для селекта
        $regions = Region::orderBy('name')->get();

        // Получаем города выбранной области (если выбрана)
        $cities = collect();
        if ($request->filled('region_id')) {
            $cities = City::where('region_id', $request->region_id)->orderBy('name')->get();
        }

        return view('admin.projects.index', compact('projects', 'regions', 'cities'));
    }

    public function approveProject(Project $project)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }

        $project->update([
            'status' => Project::MOD_PROJECT_APPROVED,
            'admin_comment' => null,
        ]);

        return redirect()->route('admin.projects')->with('success', 'Проект одобрен!');
    }

    public function rejectProject(Request $request, Project $project)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }

        $request->validate([
            'comment' => 'required|string'
        ]);

        $project->update([
            'status' => Project::MOD_PROJECT_REJECTED,
            'admin_comment' => $request->comment,
        ]);

        return redirect()->route('admin.projects')->with('success', 'Проект отклонен');
    }

    public function revisionProject(Request $request, Project $project)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Access denied.');
        }

        $request->validate([
            'comment' => 'required|string'
        ]);

        $project->update([
            'status' => Project::MOD_PROJECT_REVISION,
            'admin_comment' => $request->comment,
        ]);

        return redirect()->route('admin.projects')->with('success', 'Отправлено на доработку');
    }


    public function regions()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    public function editRegion(Region $region, Request $request)
    {
        $region->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Регион обновлен');
    }
}
