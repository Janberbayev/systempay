@extends('layout.app')

@section('content')

    <section id="roles" class="section-creative" style="background: white; padding-top: 30px;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{session('success')}}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $advertBackFrom = request('from');
                $advertBackTab = request('tab', 'on-site');
                $dashboardTabs = ['on-site', 'pending', 'archive'];
                if (! in_array($advertBackTab, $dashboardTabs, true)) {
                    $advertBackTab = 'on-site';
                }
                $advertBackHref = $advertBackFrom === 'dashboard'
                    ? route('dashboard', ['tab' => $advertBackTab])
                    : route('list-ads');
            @endphp
            <div class="row g-4">
                <div class="col-lg-8 mx-auto">
                    <div class="mb-3">
                        <a href="{{ $advertBackHref }}" class="text-decoration-none" style="color: var(--text-muted); font-weight: 500;">
                            <i class="bi bi-arrow-left me-1"></i> Назад
                        </a>
                    </div>
                    <div class="role-card-creative h-90 p-4 p-md-5 mt-5">
                        <div class="mb-3">
                            <h1 class="fw-black mb-2" style="font-size: 1.8rem; color: var(--text-primary);">
                                {{ $advert->title }}
                            </h1>
                            <div class="d-flex flex-wrap align-items-center gap-2 text-muted small">
                                <span>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $advert->region->name ?? 'Регион не указан' }}
                                    @if($advert->city)
                                        · {{ $advert->city->name }}
                                    @endif
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $advert->created_at->format('d.m.Y') }}
                                </span>
                                @if($advert->user)
                                    <span>•</span>
                                    <span>
                                        <i class="bi bi-person me-1"></i>
                                        Автор: {{ $advert->user->name }}
                                    </span>

                                    <span>•</span>
                                    <span>
                                        Тел.: {{ $advert->user->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="">
                            <h5 class="mb-2" style="color: var(--text-primary);">Описание</h5>
                            <p style="color: var(--text-secondary); line-height: 1.8;">
                                {{ $advert->content }}
                            </p>
                        </div>

                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-3 mt-5">
                            @if(auth()->check() && $advert->user_id === auth()->id())
                                <a href="{{ route('edit-ads', $advert) }}" class="btn btn-creative">
                                    <i class="bi bi-pencil-square me-2"></i>Редактировать объявление
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

