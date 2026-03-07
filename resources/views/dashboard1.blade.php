@extends('layout.app')

@section('content')

<section class="section-creative" style="padding: 40px 0; min-height: calc(100vh - 200px);">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar Navigation -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card-creative p-3" style="position: sticky; top: 100px;">
                    <h5 class="fw-bold mb-4" style="color: var(--text-primary);">
                        <i class="bi bi-person-circle me-2" style="color: var(--accent-green);"></i>
                        Личный кабинет
                    </h5>
                    <nav class="dashboard-nav">
                        <a href="#" class="dashboard-nav-item active">
                            <i class="bi bi-grid me-2"></i>
                            <span>Мои объявления</span>
                        </a>
                        <a href="#" class="dashboard-nav-item">
                            <i class="bi bi-file-text me-2"></i>
                            <span>Мои проекты</span>
                        </a>
                        <a href="#messages" class="dashboard-nav-item">
                            <i class="bi bi-envelope me-2"></i>
                            <span>Сообщения</span>
                            @if($advertsWithComments->count() > 0 || $projectsWithComments->count() > 0)
                                <span class="badge bg-danger ms-auto" style="font-size: 0.7rem;">
                                    {{ $advertsWithComments->count() + $projectsWithComments->count() }}
                                </span>
                            @endif
                        </a>
                        <a href="#" class="dashboard-nav-item">
                            <i class="bi bi-wallet2 me-2"></i>
                            <span>Счёт и платежи</span>
                        </a>
                        <a href="#" class="dashboard-nav-item">
                            <i class="bi bi-gear me-2"></i>
                            <span>Настройки</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9 col-md-8">
                <!-- Сообщения от администратора -->
                @if($advertsWithComments->count() > 0 || $projectsWithComments->count() > 0)
                    <div class="card-creative p-4 mb-4" id="messages">
                        <h2 class="fw-black mb-4" style="color: var(--text-primary);">
                            <i class="bi bi-envelope-exclamation me-2" style="color: var(--primary);"></i>
                            Сообщения от администратора
                        </h2>

                        <!-- Сообщения по объявлениям -->
                        @foreach($advertsWithComments as $advert)
                            <div class="message-card mb-3 {{ $advert->status === 'rejected' ? 'message-rejected' : 'message-revision' }}">
                                <div class="d-flex align-items-start">
                                    <div class="message-icon me-3">
                                        <i class="bi {{ $advert->status === 'rejected' ? 'bi-x-circle-fill' : 'bi-arrow-repeat' }}"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h5 class="fw-bold mb-1" style="color: var(--text-primary);">
                                                    Объявление: {{ $advert->title }}
                                                </h5>
                                                <span class="badge {{ $advert->moderation_status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark' }} mb-2">
                                                    {{ $advert->status === 'rejected' ? 'Отклонено' : 'На доработку' }}
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ $advert->updated_at->format('d.m.Y H:i') }}</small>
                                        </div>
                                        <div class="message-content">
                                            <p class="mb-0" style="color: var(--text-primary);">
                                                {{ $advert->admin_comment }}
                                            </p>
                                        </div>
                                        <a href="{{ route('list-ads') }}" class="btn btn-sm mt-2"
                                           style="background: var(--primary); color: white; border-radius: 8px; padding: 6px 12px;">
                                            <i class="bi bi-eye me-1"></i>Посмотреть объявления
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Сообщения по проектам -->
                        @foreach($projectsWithComments as $project)
                            <div class="message-card mb-3 {{ $project->status === 'rejected' ? 'message-rejected' : 'message-revision' }}">
                                <div class="d-flex align-items-start">
                                    <div class="message-icon me-3">
                                        <i class="bi {{ $project->status === 'rejected' ? 'bi-x-circle-fill' : 'bi-arrow-repeat' }}"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h5 class="fw-bold mb-1" style="color: var(--text-primary);">
                                                    Проект: {{ $project->title }}
                                                </h5>
                                                <span class="badge {{ $project->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark' }} mb-2">
                                                    {{ $project->status === 'rejected' ? 'Отклонено' : 'На доработку' }}
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ $project->updated_at->format('d.m.Y H:i') }}</small>
                                        </div>
                                        <div class="message-content">
                                            <p class="mb-0" style="color: var(--text-primary);">
                                                {{ $project->admin_comment }}
                                            </p>
                                        </div>
                                        <a href="{{ route('list-project') }}" class="btn btn-sm mt-2"
                                           style="background: var(--primary); color: white; border-radius: 8px; padding: 6px 12px;">
                                            <i class="bi bi-eye me-1"></i>Посмотреть проекты
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

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
                        <button class="dashboard-tab active" data-tab="on-site">
                            <span class="tab-label">На сайте</span>
                            <span class="tab-count">{{ $adverts->where('status', 'approved')->count() + $projects->where('status', 'approved')->count() }}</span>
                        </button>
                        <button class="dashboard-tab" data-tab="archive">
                            <span class="tab-label">В архиве</span>
                            <span class="tab-count">{{ $adverts->where('status', 'rejected')->count() + $projects->where('status', 'rejected')->count() }}</span>
                        </button>
                        <button class="dashboard-tab" data-tab="pending">
                            <span class="tab-label">На проверке</span>
                            <span class="tab-count">{{ $adverts->where('status', 'pending')->count() + $projects->where('status', 'pending')->count() }}</span>
                        </button>
                    </div>

                    <!-- Список объявлений и проектов -->
                    @if($adverts->count() > 0 || $projects->count() > 0)
                        <div class="dashboard-items">
                            <!-- Объявления -->
                            @foreach($adverts as $advert)
                                <div class="dashboard-item mb-3 p-3" style="border: 1px solid var(--border-color); border-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $advert->title }}</h5>
                                            <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ Str::limit($advert->content, 100) }}</p>
                                            <span class="badge {{ $advert->status === 'approved' ? 'bg-success' : ($advert->status === 'rejected' ? 'bg-danger' : ($advert->status === 'revision' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                                                {{ $advert->statusLabel()[0] }}
                                            </span>
                                        </div>
                                        <small class="text-muted">{{ $advert->created_at->format('d.m.Y') }}</small>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Проекты -->
                            @foreach($projects as $project)
                                <div class="dashboard-item mb-3 p-3" style="border: 1px solid var(--border-color); border-radius: 12px;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="fw-bold mb-2" style="color: var(--text-primary);">{{ $project->title }}</h5>
                                            <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ Str::limit($project->description, 100) }}</p>
                                            <span class="badge {{ $project->status === 'approved' ? 'bg-success' : ($project->status === 'rejected' ? 'bg-danger' : ($project->status === 'revision' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                                                {{ $project->statusLabel()[0] }}
                                            </span>
                                        </div>
                                        <small class="text-muted">{{ $project->created_at->format('d.m.Y') }}</small>
                                    </div>
                                </div>
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
    /* Dashboard Navigation Styles */
    .dashboard-nav {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dashboard-nav-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 10px;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
        border: 1px solid transparent;
    }

    .dashboard-nav-item i {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
    }

    .dashboard-nav-item:hover {
        background: var(--bg-card-hover);
        color: var(--text-primary);
        border-color: var(--border-color);
    }

    .dashboard-nav-item.active {
        background: rgba(16, 163, 127, 0.15);
        color: var(--accent-green);
        border-color: rgba(16, 163, 127, 0.3);
    }

    .dashboard-nav-item.active i {
        color: var(--accent-green);
    }

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

    @media (max-width: 767px) {
        .col-lg-3 {
            margin-bottom: 20px;
        }

        .card-creative {
            position: static !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.dashboard-tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add active class to clicked tab
            this.classList.add('active');

            // Here you can add logic to load different content based on tab
            const tabType = this.getAttribute('data-tab');
            console.log('Switched to tab:', tabType);
        });
    });
});
</script>

@endsection
