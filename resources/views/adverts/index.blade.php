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

        <!-- Фильтры (как list-project / admin: область, город, поиск) -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card-creative p-3 mb-3" style="background: var(--bg-card-hover); border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);">
                    <form method="GET" action="{{ route('list-ads') }}" id="advertListFilters">
                        @if($errors->any())
                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <div class="alert alert-danger mb-0 py-2 px-3" style="border-radius: 8px; font-size: 0.875rem;" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row g-2 mb-2">
                            <div class="col-md-3">
                                <label for="filter_category_ads" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                    <i class="bi bi-grid me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Категория
                                </label>
                                <select
                                    class="form-select form-select-sm"
                                    id="filter_category_ads"
                                    name="category_id"
                                    style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                    onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                >
                                    <option value="">Все категории</option>
                                    @foreach($categoryRoots as $root)
                                        <optgroup label="{{ $root->name }}">
                                            <option value="{{ $root->id }}" {{ (string) request('category_id') === (string) $root->id ? 'selected' : '' }}>
                                                Вся группа «{{ $root->name }}»
                                            </option>
                                            @foreach($root->children as $child)
                                                <option value="{{ $child->id }}" {{ (string) request('category_id') === (string) $child->id ? 'selected' : '' }}>
                                                    {{ $child->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="search_ads" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                    <i class="bi bi-search me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Поиск
                                </label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm"
                                    id="search_ads"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="По названию или содержанию..."
                                    style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                    onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                >
                            </div>
                            <div class="col-md-3">
                                <label for="filter_region_ads" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                    <i class="bi bi-geo-alt me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Область
                                </label>
                                <select
                                    class="form-select form-select-sm"
                                    id="filter_region_ads"
                                    name="region_id"
                                    style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                    onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                    onchange="document.getElementById('filter_city_ads').value=''; this.form.submit();"
                                >
                                    <option value="">Все области</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="filter_city_ads" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                    <i class="bi bi-geo me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Город
                                </label>
                                <select
                                    class="form-select form-select-sm"
                                    id="filter_city_ads"
                                    name="city_id"
                                    style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                    {{ !request('region_id') ? 'disabled' : '' }}
                                    onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                    onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                >
                                    <option value="">Все города</option>
                                    @if(request('region_id'))
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex gap-3 align-items-center flex-wrap justify-content-end" style="padding-top: 8px; border-top: 1px solid var(--border-color);">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-sm btn-creative px-3 py-1" style="border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                            <i class="bi bi-funnel-fill me-1"></i>Применить
                                        </button>
                                        <a href="{{ route('list-ads') }}" class="btn btn-sm btn-outline-secondary px-3 py-1" style="border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                            <i class="bi bi-x-circle me-1"></i>Сбросить
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Adverts Grid -->
        <div class="row g-4">
            @forelse($adverts as $advert)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                    <a href="{{ route('show-ads', $advert) }}?{{ http_build_query(['from' => 'list']) }}" class="advert-card-link text-decoration-none d-flex flex-grow-1 w-100" style="color: inherit; min-width: 0;">
                    <div class="card-creative p-4 w-100 d-flex flex-column">
                        <div class="mb-3">
                            <h5 class="fw-bold advert-card-title advert-card-user-name mb-0" title="{{ $advert->user?->first_name }}">
                                {{ $advert->user?->first_name ?? '—' }}
                            </h5>
                            @if($advert->category)
                                <span class="badge rounded-pill mt-2" style="background: rgba(4, 120, 87, 0.15); color: var(--primary); font-size: 0.75rem; font-weight: 600;">
                                    {{ $advert->category->name }}
                                </span>
                            @endif
                        </div>
                        <p class="mb-3 advert-card-desc flex-grow-1" style="color: var(--text-secondary); line-height: 1.6;">
                            {{ Str::limit(strip_tags($advert->content), 140) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted" style="color: var(--text-muted);">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $advert->created_at->format('d.m.Y') }}
                            </small>
                            <span class="btn btn-creative-accent btn-sm" style="border-radius: 30px; background: #fb923c !important; border: none !important; color: #000 !important;">
                                {{ $advert->city?->name ?? 'Не указано' }}
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
                            @if(request()->hasAny(['search', 'region_id', 'city_id', 'category_id']))
                                Нет объявлений по выбранным фильтрам
                            @else
                                Пока нет объявлений. Создайте первое объявление!
                            @endif
                        </p>
                        @if(request()->hasAny(['search', 'region_id', 'city_id', 'category_id']))
                            <a href="{{ route('list-ads') }}" class="btn btn-outline-secondary me-2 rounded-3">
                                Сбросить фильтры
                            </a>
                        @endif
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
    .advert-card-user-name {
        color: var(--text-primary);
        transition: color 0.2s ease;
    }
    .advert-card-link:hover .advert-card-user-name {
        color: var(--accent-blue);
    }
    .light-theme .advert-card-link:hover .advert-card-user-name {
        color: #2563eb;
    }

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

