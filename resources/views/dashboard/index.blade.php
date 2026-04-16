@extends('layout.app')

@section('content')

    <section class="section-creative" style="padding: 40px 0; min-height: calc(100vh - 200px);">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <x-dashboard-sidebar />

                <!-- Main Content Area -->
                <div class="col-lg-9 col-md-8">
                    <!-- Основной контент -->
                    <div class="card-creative p-4">
                        <h1 class="fw-black mb-4" style="color: var(--text-primary); font-size: 2rem;">
                            @if($adverts->count() > 0 || $projects->count() > 0)
                                Мои объявления и проекты
                            @else
                                У вас нет объявлений на сайте
                            @endif
                        </h1>

                        <!-- Status Tabs -->
                        <div class="dashboard-tabs mb-4">
                            <a class="dashboard-tab {{ $activeTab === 'on-site' ? 'active' : '' }}" href="{{ route('dashboard', ['tab' => 'on-site']) }}">
                                <span class="tab-label">На сайте</span>
                                <span class="tab-count">{{ $allAdverts->filter(fn ($a) => $a->moderation_status === 'approved' && $a->publication_status === 'active')->count() + $allProjects->filter(fn ($p) => (($p->moderation_status ?? $p->status) === 'approved') && $p->publication_status === 'active')->count() }}</span>
                            </a>
                            <a class="dashboard-tab {{ $activeTab === 'pending' ? 'active' : '' }}" href="{{ route('dashboard', ['tab' => 'pending']) }}">
                                <span class="tab-label">На проверке</span>
                                <span class="tab-count">{{ $allAdverts->where('moderation_status', 'pending')->count() + $allProjects->filter(fn($project) => (($project->moderation_status ?? $project->status) === 'pending'))->count() }}</span>
                            </a>
                            <a class="dashboard-tab {{ $activeTab === 'archive' ? 'active' : '' }}" href="{{ route('dashboard', ['tab' => 'archive']) }}">
                                <span class="tab-label">В архиве</span>
                                <span class="tab-count">{{ $allAdverts->filter(fn ($a) => $a->moderation_status === 'rejected' || $a->publication_status === 'archived')->count() + $allProjects->filter(fn ($p) => (($p->moderation_status ?? $p->status) === 'rejected') || $p->publication_status === 'archived')->count() }}</span>
                            </a>
                        </div>

                        <!-- Список объявлений и проектов -->
                        @if($adverts->count() > 0 || $projects->count() > 0)
                            <div class="dashboard-items">

                                <!-- Объявления -->
                                @foreach($adverts as $advert)
                                    @if($activeTab === 'on-site')
                                        <a href="{{ route('show-ads', $advert) }}?{{ http_build_query(['from' => 'dashboard', 'tab' => $activeTab]) }}" class="dashboard-item dashboard-item--link mb-3 p-3 d-block text-decoration-none" style="border: 1px solid var(--border-color); border-radius: 12px; color: inherit;">
                                    @else
                                        <div class="dashboard-item mb-3 p-3" style="border: 1px solid var(--border-color); border-radius: 12px;">
                                    @endif
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $advert->title }}</h5>
                                                <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ Str::limit($advert->content, 100) }}</p>
                                                <span class="badge {{ $advert->moderation_status === 'approved' ? 'bg-success' : ($advert->moderation_status === 'rejected' ? 'bg-danger' : ($advert->moderation_status === 'revision' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                                                {{ $advert->statusLabel()[0] }}
                                            </span>
{{--                                                @if($activeTab === 'on-site')--}}
{{--                                                    <p class="dashboard-item-edit mb-0 mt-2">--}}
{{--                                                        <span--}}
{{--                                                            role="link"--}}
{{--                                                            tabindex="0"--}}
{{--                                                            class="dashboard-edit-link dashboard-card-nested-action"--}}
{{--                                                            onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-ads', $advert) }}'"--}}
{{--                                                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-ads', $advert) }}'}"--}}
{{--                                                        ><i class="bi bi-pencil-square me-1"></i>Редактировать</span>--}}
{{--                                                    </p>--}}
{{--                                                @endif--}}
                                                @if($activeTab === 'on-site' && $label = $advert->remainingActivePublicationLabel())
                                                    <div class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">{{ $label }}</div>
                                                @endif
                                            </div>
                                            <small class="text-muted">{{ $advert->created_at->format('d.m.Y') }}</small>
                                        </div>
                                        @if($advert->admin_comment)
                                            <div class="admin-comment-block mt-3">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-info-circle me-2" style="color: var(--accent-green); font-size: 0.9rem; margin-top: 2px;"></i>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600;">Комментарий администратора:</small>
                                                        <p class="mb-0" style="font-size: 0.85rem; color: var(--text-primary); line-height: 1.4;">{{ $advert->admin_comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @if($activeTab === 'on-site')
                                                    <span
                                                        role="link"
                                                        tabindex="0"
                                                        class="btn btn-creative btn-sm dashboard-card-nested-action d-inline-flex align-items-center"
                                                        onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-ads', $advert) }}'"
                                                        onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-ads', $advert) }}'}"
                                                    ><i class="bi bi-eye me-1"></i>Посмотреть объявление и внести изменения</span>
                                                @else
                                                    <a href="{{ route('edit-ads', $advert) }}" class="btn btn-creative btn-sm">
                                                        <i class="bi bi-eye me-1"></i>Посмотреть объявление и внести изменения
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    @if($activeTab === 'on-site')
                                        </a>
                                    @else
                                        </div>
                                    @endif
                                @endforeach

                            <!-- Проекты -->
                                @foreach($projects as $project)
                                    @if($activeTab === 'on-site')
                                        <a href="{{ route('show-project', $project) }}?{{ http_build_query(['from' => 'dashboard', 'tab' => $activeTab]) }}" class="dashboard-item dashboard-item--link mb-3 p-3 d-block text-decoration-none" style="border: 1px solid var(--border-color); border-radius: 12px; color: inherit;">
                                    @else
                                        <div class="dashboard-item mb-3 p-3" style="border: 1px solid var(--border-color); border-radius: 12px;">
                                    @endif
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $project->title }}</h5>
                                                <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ Str::limit($project->description, 100) }}</p>
                                                <span class="badge {{ $project->moderation_status === 'approved' ? 'bg-success' : ($project->moderation_status === 'rejected' ? 'bg-danger' : ($project->moderation_status === 'revision' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                                                {{ $project->statusLabel()[0] }}
                                            </span>
{{--                                                @if($activeTab === 'on-site')--}}
{{--                                                    <p class="dashboard-item-edit mb-0 mt-2">--}}
{{--                                                        <span--}}
{{--                                                            role="link"--}}
{{--                                                            tabindex="0"--}}
{{--                                                            class="dashboard-edit-link dashboard-card-nested-action"--}}
{{--                                                            onclick="event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-project', $project) }}'"--}}
{{--                                                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault(); event.stopPropagation(); window.location.href='{{ route('edit-project', $project) }}'}"--}}
{{--                                                        ><i class="bi bi-pencil-square me-1"></i>Редактировать</span>--}}
{{--                                                    </p>--}}
{{--                                                @endif--}}
                                                @if($activeTab === 'on-site' && $label = $project->remainingActivePublicationLabel())
                                                    <div class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">{{ $label }}</div>
                                                @endif
                                                @if($activeTab === 'on-site')
                                                    <div class="dashboard-offers-stat mt-3">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="dashboard-offers-stat-icon" aria-hidden="true">
                                                                <i class="bi bi-people-fill"></i>
                                                            </div>
                                                            <div class="flex-grow-1 min-w-0">
                                                                <div class="dashboard-offers-stat-label">Количество предложений от Исполнителей</div>
                                                            </div>
                                                            <div class="dashboard-offers-stat-value">{{ $project->offers_count }}</div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <small class="text-muted">{{ $project->created_at->format('d.m.Y') }}</small>
                                        </div>
                                        @if($project->admin_comment)
                                            <div class="admin-comment-block mt-3">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-info-circle me-2" style="color: var(--accent-green); font-size: 0.9rem; margin-top: 2px;"></i>
                                                    <div class="flex-grow-1">
                                                        <small class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600;">Комментарий администратора:</small>
                                                        <p class="mb-0" style="font-size: 0.85rem; color: var(--text-primary); line-height: 1.4;">{{ $project->admin_comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @if($activeTab === 'on-site')
                                        </a>
                                    @else
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="dashboard-message">
                                <p class="text-muted mb-3" style="font-size: 1rem;">
                                    Нет подходящих объявлений. Это легко исправить,
                                    <a href="{{ route('publish') }}" class="dashboard-link">подав их</a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Dashboard Tabs */
        .dashboard-tabs {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 0;
        }

        .dashboard-tab {
            background: transparent;
            border: none;
            padding: 12px 20px;
            border-radius: 10px 10px 0 0;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-weight: 500;
            position: relative;
            margin-bottom: -2px;
            text-decoration: none;
        }

        .dashboard-tab:hover {
            background: var(--bg-card-hover);
            color: var(--text-primary);
        }

        .dashboard-tab.active {
            background: var(--bg-card);
            color: var(--text-primary);
            border-bottom: 2px solid var(--accent-green);
        }

        .dashboard-tab .tab-label {
            font-size: 0.95rem;
        }

        .dashboard-tab .tab-count {
            background: var(--bg-card-hover);
            color: var(--text-secondary);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            min-width: 24px;
            text-align: center;
        }

        .dashboard-tab.active .tab-count {
            background: var(--accent-green);
            color: white;
        }

        /* Dashboard Message */
        .dashboard-message {
            padding: 20px 0;
        }

        .dashboard-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .dashboard-link:hover {
            color: var(--accent-green);
            text-decoration: underline;
        }

        .dashboard-item-edit {
            line-height: 1.4;
        }

        .dashboard-edit-link {
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--accent-blue);
            text-decoration: none;
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .dashboard-edit-link:hover {
            color: var(--accent-green);
            text-decoration: underline;
        }

        .dashboard-edit-link .bi {
            font-size: 1rem;
            opacity: 0.9;
        }

        a.dashboard-item--link {
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        a.dashboard-item--link:hover {
            border-color: rgba(16, 163, 127, 0.45) !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        }

        .dashboard-card-nested-action {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .dashboard-offers-stat {
            padding: 12px 14px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(16, 163, 127, 0.1) 0%, rgba(16, 163, 127, 0.03) 100%);
            border: 1px solid rgba(16, 163, 127, 0.22);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .dashboard-offers-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            background: rgba(16, 163, 127, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-green);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .dashboard-offers-stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: 0.02em;
            line-height: 1.35;
        }

        .dashboard-offers-stat-value {
            min-width: 2.5rem;
            min-height: 2.5rem;
            padding: 0 10px;
            border-radius: 12px;
            background: var(--accent-green);
            color: #fff;
            font-weight: 700;
            font-size: 1.15rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(16, 163, 127, 0.35);
            flex-shrink: 0;
            line-height: 1;
        }

        /* Message Card Styles */
        .message-card {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            transition: all 0.2s ease;
        }

        .message-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .message-rejected {
            background: rgba(220, 53, 69, 0.05);
            border-color: rgba(220, 53, 69, 0.2);
        }

        .message-revision {
            background: rgba(255, 193, 7, 0.05);
            border-color: rgba(255, 193, 7, 0.2);
        }

        .message-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .message-rejected .message-icon {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .message-revision .message-icon {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .message-content {
            padding: 12px;
            background: var(--bg-card-hover);
            border-radius: 8px;
            margin-top: 8px;
        }

        /* Admin Comment Block */
        .admin-comment-block {
            padding: 10px 12px;
            background: rgba(16, 163, 127, 0.08);
            border-left: 3px solid var(--accent-green);
            border-radius: 6px;
            margin-top: 12px;
        }

        .admin-comment-block p {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .dashboard-tabs {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .dashboard-tab {
                white-space: nowrap;
                flex-shrink: 0;
            }
        }

    </style>
@endsection
