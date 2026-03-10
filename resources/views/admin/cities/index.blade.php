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

        <!-- Cities Content -->
            <div class="card-creative p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-black mb-0">
                        <i class="bi bi-geo-alt me-2" style="color: var(--primary);"></i>
                        Управление городами
                    </h2>
                    <button 
                        type="button"
                        class="btn btn-creative-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#addCityModal"
                    >
                        <i class="bi bi-plus-circle me-2"></i>Добавить Город
                    </button>
                </div>
                <p class="text-muted mb-4">
                    Просмотр и управление городами.
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: var(--bg-card-hover);">
                        <tr>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">ID</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Регион</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Город</th>
                            <th class="fw-bold text-center" style="border-bottom: 1px solid var(--border-color);">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->region->name ?? '—' }}</td>
                                <td>{{ $city->name }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCityModal"
                                            data-city-id="{{ $city->id }}"
                                            data-city-name="{{ $city->name }}"
                                            data-city-region-id="{{ $city->region_id }}"
                                        >
                                            <i class="bi bi-pencil me-1"></i>Редактировать
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteCityModal"
                                            data-city-id="{{ $city->id }}"
                                            data-city-name="{{ $city->name }}"
                                        >
                                            <i class="bi bi-trash me-1"></i>Удалить
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    </style>

    <!-- Add City Modal -->
    <div class="modal fade" id="addCityModal" tabindex="-1" aria-labelledby="addCityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-creative" style="border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(4, 120, 87, 0.1); border-color: #047857;">
                        <i class="bi bi-plus-circle" style="color: #047857;"></i>
                    </div>
                    <h5 class="modal-title fw-black" id="addCityModalLabel">
                        Добавить город
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addCityForm" method="POST" action="{{ route('admin.cities.store') }}">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="addCityName" class="form-label fw-bold">
                                <i class="bi bi-geo-alt me-2" style="color: var(--primary);"></i>
                                Название города
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="addCityName"
                                name="name"
                                required
                                style="border-width: 2px; border-color: var(--border-color); border-radius: 12px; padding: 12px;"
                                placeholder="Введите название города"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="addCityRegion" class="form-label fw-bold">
                                <i class="bi bi-map me-2" style="color: var(--primary);"></i>
                                Регион
                            </label>
                            <select
                                class="form-control"
                                id="addCityRegion"
                                name="region_id"
                                required
                                style="border-width: 2px; border-color: var(--border-color); border-radius: 12px; padding: 12px;"
                            >
                                <option value="">Выберите регион</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-x-circle me-2"></i>Отмена
                        </button>
                        <button type="submit" class="btn btn-creative" style="border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-check-circle me-2"></i>Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete City Confirmation Modal -->
    <div class="modal fade" id="deleteCityModal" tabindex="-1" aria-labelledby="deleteCityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-creative" style="border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(220, 53, 69, 0.1); border-color: #dc3545;">
                        <i class="bi bi-exclamation-triangle" style="color: #dc3545;"></i>
                    </div>
                    <h5 class="modal-title fw-black" id="deleteCityModalLabel">
                        Подтверждение удаления города
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteCityForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body p-4">
                        <p class="lead mb-0">
                            Вы уверены, что хотите удалить город "<strong id="cityNameToDelete"></strong>"?
                        </p>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-x-circle me-2"></i>Отмена
                        </button>
                        <button type="submit" class="btn btn-outline-danger" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-trash me-2"></i>Да, удалить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit City Modal -->
    <div class="modal fade" id="editCityModal" tabindex="-1" aria-labelledby="editCityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-creative" style="border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(4, 120, 87, 0.1); border-color: #047857;">
                        <i class="bi bi-pencil-square" style="color: #047857;"></i>
                    </div>
                    <h5 class="modal-title fw-black" id="editCityModalLabel">
                        Редактировать город
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCityForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="editCityName" class="form-label fw-bold">
                                <i class="bi bi-geo-alt me-2" style="color: var(--primary);"></i>
                                Название города
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="editCityName"
                                name="name"
                                required
                                style="border-width: 2px; border-color: var(--border-color); border-radius: 12px; padding: 12px;"
                                placeholder="Введите название города"
                            >
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editCityRegion" class="form-label fw-bold">
                                <i class="bi bi-map me-2" style="color: var(--primary);"></i>
                                Регион
                            </label>
                            <select
                                class="form-control"
                                id="editCityRegion"
                                name="region_id"
                                required
                                style="border-width: 2px; border-color: var(--border-color); border-radius: 12px; padding: 12px;"
                            >
                                <option value="">Выберите регион</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-x-circle me-2"></i>Отмена
                        </button>
                        <button type="submit" class="btn btn-creative" style="border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                            <i class="bi bi-check-circle me-2"></i>Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add City Modal
            const addCityModal = document.getElementById('addCityModal');
            const addCityForm = document.getElementById('addCityForm');
            const addCityNameInput = document.getElementById('addCityName');
            const addCityRegionSelect = document.getElementById('addCityRegion');

            if (addCityModal) {
                addCityModal.addEventListener('show.bs.modal', function () {
                    // Очищаем форму при открытии модального окна
                    if (addCityForm) {
                        addCityForm.reset();
                    }
                    if (addCityNameInput) {
                        addCityNameInput.value = '';
                    }
                    if (addCityRegionSelect) {
                        addCityRegionSelect.value = '';
                    }
                });
            }

            // Edit City Modal
            const editCityModal = document.getElementById('editCityModal');
            const editCityForm = document.getElementById('editCityForm');
            const editCityNameInput = document.getElementById('editCityName');
            const editCityRegionSelect = document.getElementById('editCityRegion');

            if (editCityModal) {
                editCityModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const cityId = button.getAttribute('data-city-id');
                    const cityName = button.getAttribute('data-city-name');
                    const cityRegionId = button.getAttribute('data-city-region-id');

                    // Заполняем форму данными города
                    editCityNameInput.value = cityName || '';
                    editCityRegionSelect.value = cityRegionId || '';
                    
                    // Устанавливаем action формы
                    editCityForm.action = `{{ route('admin.cities.update', ':id') }}`.replace(':id', cityId);
                });
            }

            // Delete City Modal
            const deleteCityModal = document.getElementById('deleteCityModal');
            const deleteCityForm = document.getElementById('deleteCityForm');
            const cityNameToDelete = document.getElementById('cityNameToDelete');

            if (deleteCityModal) {
                deleteCityModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const cityId = button.getAttribute('data-city-id');
                    const cityName = button.getAttribute('data-city-name');

                    // Заполняем данные города
                    cityNameToDelete.textContent = cityName || '';
                    
                    // Устанавливаем action формы
                    deleteCityForm.action = `{{ route('admin.cities.destroy', ':id') }}`.replace(':id', cityId);
                });
            }
        });
    </script>

@endsection
