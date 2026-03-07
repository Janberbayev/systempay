<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Project;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
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
            ->whereIn('status', ['rejected', 'revision'])
            ->with(['region', 'city'])
            ->orderBy('updated_at', 'desc')
            ->get();

        // Все объявления и проекты пользователя для отображения
        $adverts = Advert::where('user_id', $user->id)
            ->with(['region', 'city'])
            ->orderBy('created_at', 'desc')
            ->get();

        $projects = Project::where('user_id', $user->id)
            ->with(['region', 'city'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', compact('advertsWithComments', 'projectsWithComments', 'adverts', 'projects'));
    }

    public function myDeals()
    {
        $user = Auth::user();

        // Получаем сделки пользователя (заказы)
        // Пока используем модель Order, в будущем можно расширить
        $deals = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Если нет связи user_id в Order, получаем пустой массив
        // В будущем можно добавить связи с проектами/объявлениями
        $deals = collect([]);

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
            ->whereIn('status', ['rejected', 'revision'])
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
