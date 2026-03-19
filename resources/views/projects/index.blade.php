@extends('layout.app')

@section('content')

    <section class="section-creative" style="padding: 60px 0;">
        <div class="container">

            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="display-6 fw-black mb-3" style="color: var(--text-primary);">
                                Список проектов
                            </h1>
                        </div>
                        @can('add projects')
                            <a href="{{route('add-project')}}" class="btn btn-creative">
                                <i class="bi bi-plus-circle me-2"></i>Создать проект
                            </a>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card-creative p-4">
                        <form method="GET" action="#" class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                <span class="input-group-text" style="background: var(--bg-card); border-color: var(--border-color); color: var(--text-secondary);">
                                    <i class="bi bi-search"></i>
                                </span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="search"
                                        placeholder="Поиск по названию или тексту проекта..."
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
                @forelse($projects as $project)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('show-project', $project) }}" style="text-decoration: none;">
                        <div class="card-creative p-4 h-100">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold mb-0" style="color: var(--text-primary);">
                                    {{ $project->title }}
                                </h5>
                            </div>
                            <p class="mb-3" style="color: var(--text-secondary); line-height: 1.6;">
                                {{ Str::limit($project->description, 150) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="color: var(--text-muted);">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $project->created_at->format('d.m.Y') }}
                                </small>
                                <span class="btn btn-creative-accent btn-sm" style="border-radius: 30px; background: var(--accent-green) !important; border: none !important; color: #000 !important;">
                                    {{ $project->city->name }}
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
                            <h3 class="fw-bold mb-3" style="color: var(--text-primary);">Проект не найден</h3>
                            <p class="mb-4" style="color: var(--text-secondary);">
                                @if(request('search'))
                                    По запросу "{{ request('search') }}" ничего не найдено
                                @else
                                    Пока нет проекта. Создайте первый проект!
                                @endif
                            </p>
                            @can('add projects')
                                <a href="#" class="btn btn-creative">
                                    <i class="bi bi-plus-circle me-2"></i>Создать проект
                                </a>
                            @endcan
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
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
