<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Deal;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $activeTab = $request->query('tab', 'on-site');

        // Получаем объявления пользователя с комментариями админа
        $advertsWithComments = Advert::where('user_id', $user->id)
            ->whereNotNull('admin_comment')
            ->whereIn('moderation_status', ['rejected', 'revision'])
            ->with(['region', 'city'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Получаем проекты пользователя с комментариями админа
        $projectsWithComments = Project::where('user_id', $user->id)
            ->whereNotNull('admin_comment')
            ->whereIn('moderation_status', ['rejected', 'revision'])
            ->with(['region', 'city'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Все объявления и проекты пользователя для счетчиков и фильтрации
        $allAdverts = Advert::where('user_id', $user->id)
            ->with(['region', 'city'])
            ->orderBy('created_at', 'desc')
            ->get();

        $allProjects = Project::where('user_id', $user->id)
            ->with(['region', 'city'])
            ->withCount('offers')
            ->orderBy('created_at', 'desc')
            ->get();

        $statusMap = [
            'on-site' => 'approved',
            'archive' => 'rejected',
            'pending' => 'pending',
        ];

        if (! array_key_exists($activeTab, $statusMap)) {
            $activeTab = 'on-site';
        }

        $adverts = $allAdverts->filter(function ($advert) use ($activeTab, $statusMap) {
            return match ($activeTab) {
                'on-site' => $advert->moderation_status === 'approved'
                    && $advert->publication_status === 'active',
                'archive' => $advert->moderation_status === 'rejected'
                    || $advert->publication_status === 'archived',
                default => $advert->moderation_status === $statusMap[$activeTab],
            };
        })->values();

        $projects = $allProjects->filter(function ($project) use ($activeTab, $statusMap) {
            $projectStatus = $project->moderation_status ?? $project->status;

            return match ($activeTab) {
                'on-site' => $projectStatus === 'approved'
                    && $project->publication_status === 'active',
                'archive' => $projectStatus === 'rejected'
                    || $project->publication_status === 'archived',
                default => $projectStatus === $statusMap[$activeTab],
            };
        })->values();

        return view('dashboard.index', compact(
            'advertsWithComments',
            'projectsWithComments',
            'adverts',
            'projects',
            'allAdverts',
            'allProjects',
            'activeTab'
        ));
    }

    public function myDeals()
    {
        $user = Auth::user();

        $deals = Deal::query()
            ->where(function ($q) use ($user) {
                $q->where('client_id', $user->id)
                    ->orWhere('contractor_id', $user->id);
            })
            ->with('project')
            ->withCount('contractVersions')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.my-deals', compact('deals'));
    }

    public function messages()
    {
        $user = Auth::user();

        // Получаем объявления пользователя с комментариями админа
        $advertsWithComments = Advert::where('user_id', $user->id)
            ->whereNotNull('admin_comment')
            ->whereIn('moderation_status', ['rejected', 'revision'])
            ->with(['region', 'city'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Получаем проекты пользователя с комментариями админа
        $projectsWithComments = Project::where('user_id', $user->id)
            ->whereNotNull('admin_comment')
            ->whereIn('moderation_status', ['rejected', 'revision'])
            ->with(['region', 'city'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dashboard.messages', compact('advertsWithComments', 'projectsWithComments'));
    }

    //    public function myAds()
    //    {
    //        $user = Auth::user();
    //        $adverts = Advert::$user = A
    //    }
}
