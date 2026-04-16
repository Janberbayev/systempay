@extends('layout.app')

@section('content')

    <section class="section-creative" style="padding: 60px 0;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="display-6 fw-black mb-3" style="color: var(--text-primary);">
                            Список объявлений
                        </h1>
                    </div>
                    @can('add ads')
                        <a href="{{ route('add-ads') }}" class="btn btn-creative">
                            <i class="bi bi-plus-circle me-2"></i>Создать объявление
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card-creative p-4">
                    <form method="GET" action="{{ route('list-ads') }}" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text" style="background: var(--bg-card); border-color: var(--border-color); color: var(--text-secondary);">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="search"
                                    placeholder="Поиск по названию или тексту объявления..."
                                    value="{{ request('search') }}"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-creative w-100" style="padding: 0.375rem 0.75rem; height: calc(1.5em + 0.75rem + 2px);">
                                <i class="bi bi-search me-2"></i>Найти
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Adverts Grid -->
        <div class="row g-4">
            @forelse($adverts as $advert)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('show-ads', $advert) }}?{{ http_build_query(['from' => 'list']) }}" style="text-decoration: none;">
                    <div class="card-creative p-4 h-100">
                        <div class="mb-3">
                            <h5 class="fw-bold advert-card-title" style="color: var(--text-primary);" title="{{ $advert->title }}">
                                {{ Str::limit($advert->title, 72) }}
                            </h5>
                        </div>
                        <p class="mb-3 advert-card-desc" style="color: var(--text-secondary); line-height: 1.6;">
                            {{ Str::limit(strip_tags($advert->content), 140) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted" style="color: var(--text-muted);">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $advert->created_at->format('d.m.Y') }}
                            </small>
                            <span class="btn btn-creative-accent btn-sm" style="border-radius: 30px; background: #fb923c !important; border: none !important; color: #000 !important;">
                                {{ $advert->city->name }}
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="card-creative p-5 text-center">
                        <div class="icon-creative primary mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem; opacity: 0.5;">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h3 class="fw-bold mb-3" style="color: var(--text-primary);">Объявлений не найдено</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">
                            @if(request('search'))
                                По запросу "{{ request('search') }}" ничего не найдено
                            @else
                                Пока нет объявлений. Создайте первое объявление!
                            @endif
                        </p>
                        @can('add ads')
                            <a href="{{ route('add-ads') }}" class="btn btn-creative">
                                <i class="bi bi-plus-circle me-2"></i>Создать объявление
                            </a>
                        @endcan
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($adverts->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $adverts->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .advert-card-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }
    .advert-card-desc {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }

    /* Аккуратные кнопки действий в таблицах */
    .btn-action-edit {
        background: rgba(4, 120, 87, 0.1);
        color: #047857;
        border: 1px solid rgba(4, 120, 87, 0.3);
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-action-edit:hover {
        background: rgba(4, 120, 87, 0.15);
        border-color: #047857;
        color: #047857;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(4, 120, 87, 0.2);
    }

    .btn-action-delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-action-delete:hover {
        background: rgba(220, 53, 69, 0.15);
        border-color: #dc3545;
        color: #dc3545;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
    }

    /* Стили для пагинации */
    .pagination {
        --bs-pagination-bg: var(--bg-card);
        --bs-pagination-border-color: var(--border-color);
        --bs-pagination-color: var(--text-primary);
        --bs-pagination-hover-bg: var(--bg-card-hover);
        --bs-pagination-hover-color: var(--accent-green);
        --bs-pagination-active-bg: var(--accent-green);
        --bs-pagination-active-border-color: var(--accent-green);
    }

    .pagination .page-link {
        border-radius: 8px;
        margin: 0 4px;
        border: 1px solid var(--border-color);
    }

    .pagination .page-link:hover {
        border-color: var(--accent-green);
    }
</style>

@endsection

