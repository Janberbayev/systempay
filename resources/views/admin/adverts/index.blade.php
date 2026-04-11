@extends('layout.app')

@section('content')

<section class="section-creative" style="padding: 60px 0;">
    <div class="container">
        @role('admin')
        <div class="row mb-5">
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-12">
                <div class="text-center mb-4">
                    <h2 class="fw-black mb-3">
                        <i class="bi bi-shield-check me-2" style="color: var(--primary);"></i>
                        Админ-панель
                    </h2>
                </div>
            </div>
        </div>
        @include('components.admin-nav')

        <!-- Adverts Table for Admin -->
        <div class="card-creative p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-black mb-0">
                    <i class="bi bi-megaphone me-2" style="color: var(--primary);"></i>
                    Управление объявлениями
                </h2>
            </div>
            <p class="text-muted mb-4">
                Просмотр и управление объявлениями. Одобряйте или отклоняйте объявления.
            </p>

            <!-- Filter Form -->
            <div class="card-creative p-3 mb-3" style="background: var(--bg-card-hover); border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);">
                <form method="GET" action="{{ route('admin.adverts') }}" id="filterForm">
                    <!-- Первая строка: Основные фильтры -->
                    <div class="row g-2 mb-2">
                        <div class="col-md-5">
                            <label for="search" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                <i class="bi bi-search me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Поиск
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="По названию или содержанию..."
                                style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                            >
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                <i class="bi bi-funnel me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Статус
                            </label>
                            <select
                                class="form-select form-select-sm"
                                id="status"
                                name="status"
                                style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                            >
                                <option value="">Все статусы</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>На проверке</option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Одобрено</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Отклонено</option>
                                <option value="revision" {{ request('status') === 'revision' ? 'selected' : '' }}>На доработку</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_region_id" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                <i class="bi bi-geo-alt me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Область
                            </label>
                            <select
                                class="form-select form-select-sm"
                                id="filter_region_id"
                                name="region_id"
                                style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 12px; font-size: 0.875rem; transition: all 0.2s ease;"
                                onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
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
                            <label for="filter_city_id" class="form-label fw-semibold mb-1 small" style="color: var(--text-primary); font-size: 0.875rem;">
                                <i class="bi bi-geo me-1" style="color: var(--primary); font-size: 0.875rem;"></i>Город
                            </label>
                            <select
                                class="form-select form-select-sm"
                                id="filter_city_id"
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

                    <!-- Фильтр по датам и кнопки действий -->
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex gap-3 align-items-center" style="padding-top: 8px; border-top: 1px solid var(--border-color);">
                                @if(request()->hasAny(['search', 'status', 'region_id', 'city_id', 'date_from', 'date_to']))
                                    <span class="badge bg-info px-2 py-1" style="font-size: 0.75rem; border-radius: 6px;">
                                        <i class="bi bi-info-circle me-1"></i>Активны фильтры
                                    </span>
                                @endif

                                <!-- Фильтр по датам -->
                                <div class="d-flex align-items-center gap-2 flex-grow-1">
                                    <label class="form-label fw-semibold mb-0 small d-flex align-items-center" style="color: var(--text-primary); font-size: 0.875rem; white-space: nowrap;">
                                        <i class="bi bi-calendar-range me-1" style="color: var(--primary);"></i>Период:
                                    </label>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        id="date_from"
                                        name="date_from"
                                        value="{{ request('date_from') }}"
                                        style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 10px; font-size: 0.875rem; width: 150px; transition: all 0.2s ease;"
                                        onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                        onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                        placeholder="От"
                                    >
                                    <i class="bi bi-arrow-right" style="color: var(--text-secondary); font-size: 0.875rem;"></i>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        id="date_to"
                                        name="date_to"
                                        value="{{ request('date_to') }}"
                                        style="border-radius: 8px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); padding: 6px 10px; font-size: 0.875rem; width: 150px; transition: all 0.2s ease;"
                                        onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 0.15rem rgba(4, 120, 87, 0.1)'"
                                        onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'"
                                        placeholder="До"
                                    >
                                </div>

                                <!-- Кнопки действий -->
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-creative px-3 py-1" style="border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                        <i class="bi bi-funnel-fill me-1"></i>Применить
                                    </button>
                                    <a href="{{ route('admin.adverts') }}" class="btn btn-sm btn-outline-secondary px-3 py-1" style="border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                        <i class="bi bi-x-circle me-1"></i>Сбросить
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" style="font-size: 0.85rem;">
                    <thead style="background: var(--bg-card-hover);">
                        <tr>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">ID</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Наименование и ссылка</th>
{{--                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Содержание объявления</th>--}}
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Город</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Дата объяв</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Дата окон объяв</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Автор</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Статус объяв</th>
                            <th class="fw-bold text-center" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Статус Модератора</th>
                            <th class="fw-bold text-center" style="border-bottom: 1px solid var(--border-color); color: var(--text-primary); padding: 6px 8px;">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($adverts as $adver)
                            <tr>
                                <td style="padding: 4px 8px;">{{ $adver->id }}</td>
                                <td style="padding: 4px 8px; font-size: 0.85rem;"><a href="#">{{ $adver->title }}</a></td>
{{--                                <td style="padding: 4px 8px; font-size: 0.85rem;">{{ Str::limit($adver->content, 50) }}</td>--}}
                                <td style="padding: 4px 8px;">
                                    @if($adver->city)
                                        <div class="d-flex align-items-center">
                                            <div style="font-size: 0.8rem;">
                                                <span>{{ $adver->city->name }}</span>
                                                @if($adver->region)
                                                    <br><small class="text-muted" style="font-size: 0.75rem;">{{ $adver->region->name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted" style="font-size: 0.8rem;">—</span>
                                    @endif
                                </td>
                                <td style="padding: 4px 8px; font-size: 0.80rem;">{{ $adver->created_at->format('d.m.Y H:i') }}</td>
                                <td style="padding: 4px 8px; font-size: 0.80rem;">{{ $adver->expires_at ? $adver->expires_at->format('d.m.Y H:i') : '—' }}</td>
                                <td style="padding: 4px 8px; font-size: 0.85rem;">
                                    <div style="font-size: 0.8rem;">
                                        <strong>{{ $adver->user->name }}</strong><br>
{{--                                        <span class="text-muted" style="font-size: 0.75rem;">{{ $adver->user->email }}</span><br>--}}
                                        <span class="text-muted" style="font-size: 0.75rem;">{{ $adver->user->phone }}</span>
                                    </div>
                                </td>
                                <td style="padding: 4px 8px; font-size: 0.85rem;">{{ $adver->publication_status }}</td>
                                <td class="text-center" style="padding: 4px 8px;">
                                    @if($adver->moderation_status === 'pending')
                                        <span class="badge bg-warning text-dark" style="font-size: 0.75rem; padding: 3px 6px;">
                                            <i class="bi bi-clock-history me-1"></i>На проверке
                                        </span>
                                    @elseif($adver->moderation_status === 'approved')
                                        <span class="badge bg-success" style="font-size: 0.75rem; padding: 3px 6px;">
                                            <i class="bi bi-check-circle me-1"></i>Одобрено
                                        </span>
                                    @elseif($adver->moderation_status === 'rejected')
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <span class="badge bg-danger" style="font-size: 0.75rem; padding: 3px 6px;">Отклонён</span>
                                            @if($adver->admin_comment)
                                                <div class="admin-comment admin-comment-rejected">
                                                    <i class="bi bi-chat-left-text me-1" style="font-size: 0.7rem;"></i>
                                                    <span style="font-size: 0.7rem;">{{ $adver->admin_comment }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif($adver->moderation_status === 'revision')
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <span class="badge bg-warning text-dark" style="font-size: 0.75rem; padding: 3px 6px;">На доработку</span>
                                            @if($adver->admin_comment)
                                                <div class="admin-comment admin-comment-revision">
                                                    <i class="bi bi-chat-left-text me-1" style="font-size: 0.7rem;"></i>
                                                    <span style="font-size: 0.7rem;">{{ $adver->admin_comment }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center" style="padding: 4px 8px;">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <form action="{{ route('adverts.approve', $adver) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-action-approve" type="submit" title="Одобрить">
                                                <i class="bi bi-check-circle me-1"></i>Approve
                                            </button>
                                        </form>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-revise"
                                            data-bs-toggle="modal"
                                            data-bs-target="#revisionAdvertModal"
                                            data-advert-id="{{ $adver->id }}"
                                            data-advert-title="{{ $adver->title }}"
                                            data-advert-author="{{ $adver->user->name }}"
                                            title="Отправить на доработку"
                                        >
                                            <i class="bi bi-arrow-repeat me-1"></i>Revise
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rejectAdvertModal"
                                            data-advert-id="{{ $adver->id }}"
                                            data-advert-title="{{ $adver->title }}"
                                            data-advert-author="{{ $adver->user->name }}"
                                            title="Отклонить"
                                        >
                                            <i class="bi bi-x-circle me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                                    <p class="mt-2 mb-0">
                                        @if(request()->hasAny(['search', 'status', 'region_id', 'city_id', 'date_from', 'date_to']))
                                            Объявления не найдены по заданным фильтрам
                                        @else
                                            Нет объявлений
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'status', 'region_id', 'city_id', 'date_from', 'date_to']))
                                        <a href="{{ route('admin.adverts') }}" class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="bi bi-x-circle me-1"></i>Сбросить фильтры
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($adverts->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $adverts->links() }}
                </div>
            @endif

            <!-- Results Info -->
            <div class="mt-3 text-muted text-center">
                <small>
                    <i class="bi bi-info-circle me-1"></i>
                    Показано {{ $adverts->firstItem() ?? 0 }} - {{ $adverts->lastItem() ?? 0 }} из {{ $adverts->total() }} объявлений
                </small>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card-creative p-5 text-center">
                    <div class="icon-creative primary mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                        <i class="bi bi-lock"></i>
                    </div>
                    <h2 class="fw-black mb-3">Доступ запрещен</h2>
                    <p class="lead mb-4">У вас нет прав доступа к этой странице.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-creative">
                        <i class="bi bi-arrow-left me-2"></i>Вернуться на главную
                    </a>
                </div>
            </div>
        </div>
        @endrole
    </div>
</section>

<style>
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
        background: #dc3545;
        color: #ffffff;
        border: 1px solid #dc3545;
        border-radius: 6px;
        padding: 3px 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-action-delete:hover {
        background: #bb2d3b;
        border-color: #bb2d3b;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    }

    .btn-action-approve {
        background: #198754;
        color: #ffffff;
        border: 1px solid #198754;
        border-radius: 6px;
        padding: 3px 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .btn-action-approve:hover {
        background: #157347;
        border-color: #157347;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(25, 135, 84, 0.3);
    }

    .btn-action-revise {
        background: #ffc107;
        color: #000000;
        border: 1px solid #ffc107;
        border-radius: 6px;
        padding: 3px 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-action-revise:hover {
        background: #ffb300;
        border-color: #ffb300;
        color: #000000;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
    }

    /* Стилизованные комментарии администратора */
    .admin-comment {
        max-width: 200px;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.7rem;
        line-height: 1.4;
        word-wrap: break-word;
        display: flex;
        align-items: flex-start;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .admin-comment:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .admin-comment i {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .admin-comment span {
        flex: 1;
    }

    .admin-comment-rejected {
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.3);
        color: #dc3545;
    }

    .admin-comment-rejected i {
        color: #dc3545;
    }

    .admin-comment-revision {
        background: rgba(255, 193, 7, 0.15);
        border: 1px solid rgba(255, 193, 7, 0.4);
        color: #856404;
    }

    .admin-comment-revision i {
        color: #ffc107;
    }

    /* Стили для формы фильтрации */
    #filterForm .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    #filterForm .form-control,
    #filterForm .form-select {
        transition: all 0.2s ease;
    }

    #filterForm .form-control:focus,
    #filterForm .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(4, 120, 87, 0.15);
    }

    #filterForm .btn-creative {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 20px;
    }

    #filterForm .btn-outline-secondary {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 20px;
    }
</style>

<!-- Revision Advert Modal -->
<div class="modal fade" id="revisionAdvertModal" tabindex="-1" aria-labelledby="revisionAdvertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-creative" style="border: none;">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(255, 193, 7, 0.1); border-color: #ffc107;">
                    <i class="bi bi-arrow-repeat" style="color: #ffc107;"></i>
                </div>
                <h5 class="modal-title fw-black" id="revisionAdvertModalLabel">
                    Отправка на доработку
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="revisionAdvertForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <p class="lead mb-3">
                        Отправить объявление <strong id="advertTitleToRevise"></strong> на доработку?
                    </p>
                    <div class="card-creative p-3 mb-3" style="background: rgba(107, 114, 128, 0.08); border: 1px solid rgba(107, 114, 128, 0.25);">
                        <p class="mb-1"><strong>Автор:</strong> <span id="advertAuthorToRevise"></span></p>
                    </div>
                    <div class="mb-3">
                        <label for="revisionComment" class="form-label fw-bold" style="color: var(--text-primary);">
                            <i class="bi bi-chat-left-text me-2"></i>Комментарий <span class="text-danger">*</span>
                        </label>
                        <textarea
                            class="form-control"
                            id="revisionComment"
                            name="comment"
                            rows="4"
                            placeholder="Укажите, что нужно исправить в объявлении..."
                            required
                            style="border-radius: 12px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary);"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-x-circle me-2"></i>Отмена
                    </button>
                    <button type="submit" class="btn btn-warning" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-arrow-repeat me-2"></i>Отправить на доработку
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Advert Confirmation Modal -->
<div class="modal fade" id="rejectAdvertModal" tabindex="-1" aria-labelledby="rejectAdvertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-creative" style="border: none;">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(220, 53, 69, 0.1); border-color: #dc3545;">
                    <i class="bi bi-exclamation-triangle" style="color: #dc3545;"></i>
                </div>
                <h5 class="modal-title fw-black" id="rejectAdvertModalLabel">
                    Подтверждение отклонения объявления
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectAdvertForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <p class="lead mb-3">
                        Вы уверены, что хотите отклонить объявление <strong id="advertTitleToReject"></strong>?
                    </p>
                    <div class="card-creative p-3 mb-3" style="background: rgba(107, 114, 128, 0.08); border: 1px solid rgba(107, 114, 128, 0.25);">
                        <p class="mb-1"><strong>Автор:</strong> <span id="advertAuthorToReject"></span></p>
                    </div>
                    <div class="mb-3">
                        <label for="rejectComment" class="form-label fw-bold" style="color: var(--text-primary);">
                            <i class="bi bi-chat-left-text me-2"></i>Причина отклонения <span class="text-danger">*</span>
                        </label>
                        <textarea
                            class="form-control"
                            id="rejectComment"
                            name="comment"
                            rows="4"
                            placeholder="Укажите причину отклонения объявления..."
                            required
                            style="border-radius: 12px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary);"
                        ></textarea>
                    </div>
                    <div class="alert alert-warning mb-0" style="border-radius: 12px; border: 1px solid var(--warning);">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Внимание!</strong> Это действие нельзя отменить. Объявление будет отклонено.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-x-circle me-2"></i>Отмена
                    </button>
                    <button type="submit" class="btn btn-outline-danger" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-trash me-2"></i>Да, отклонить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revision Modal
    const revisionAdvertModal = document.getElementById('revisionAdvertModal');
    const revisionAdvertForm = document.getElementById('revisionAdvertForm');
    const advertTitleToRevise = document.getElementById('advertTitleToRevise');
    const advertAuthorToRevise = document.getElementById('advertAuthorToRevise');

    if (revisionAdvertModal) {
        revisionAdvertModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const advertId = button.getAttribute('data-advert-id');
            const advertTitle = button.getAttribute('data-advert-title');
            const advertAuthor = button.getAttribute('data-advert-author');

            advertTitleToRevise.textContent = advertTitle;
            advertAuthorToRevise.textContent = advertAuthor;
            revisionAdvertForm.action = '{{ route("adverts.revision", ":id") }}'.replace(':id', advertId);
        });
    }

    // Reject Modal
    const rejectAdvertModal = document.getElementById('rejectAdvertModal');
    const rejectAdvertForm = document.getElementById('rejectAdvertForm');
    const advertTitleToReject = document.getElementById('advertTitleToReject');
    const advertAuthorToReject = document.getElementById('advertAuthorToReject');

    if (rejectAdvertModal) {
        rejectAdvertModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const advertId = button.getAttribute('data-advert-id');
            const advertTitle = button.getAttribute('data-advert-title');
            const advertAuthor = button.getAttribute('data-advert-author');

            advertTitleToReject.textContent = advertTitle;
            advertAuthorToReject.textContent = advertAuthor;
            rejectAdvertForm.action = '{{ route("adverts.reject", ":id") }}'.replace(':id', advertId);
        });
    }

    // Filter Region and City dependent selects
    const filterRegionSelect = document.getElementById('filter_region_id');
    const filterCitySelect = document.getElementById('filter_city_id');

    if (filterRegionSelect && filterCitySelect) {
        filterRegionSelect.addEventListener('change', function() {
            const regionId = this.value;
            filterCitySelect.innerHTML = '<option value="">Загрузка...</option>';
            filterCitySelect.disabled = true;

            if (!regionId) {
                filterCitySelect.innerHTML = '<option value="">Все города</option>';
                filterCitySelect.disabled = true;
                return;
            }

            fetch(`/api/cities/${regionId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка загрузки городов');
                    }
                    return response.json();
                })
                .then(cities => {
                    filterCitySelect.innerHTML = '<option value="">Все города</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        filterCitySelect.appendChild(option);
                    });
                    filterCitySelect.disabled = false;

                    // Восстанавливаем выбранный город при ошибках валидации
                    const oldCityId = @json(request('city_id'));
                    if (oldCityId) {
                        filterCitySelect.value = oldCityId;
                    }
                })
                .catch(error => {
                    console.error('Ошибка загрузки городов:', error);
                    filterCitySelect.innerHTML = '<option value="">Ошибка загрузки городов</option>';
                    filterCitySelect.disabled = true;
                });
        });

        // Если есть выбранная область при загрузке (например, после применения фильтра)
        const oldRegionId = @json(request('region_id'));
        if (oldRegionId && filterCitySelect.disabled) {
            filterRegionSelect.dispatchEvent(new Event('change'));
        }
    }
});
</script>

@endsection
