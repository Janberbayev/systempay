@extends('layout.app')

@section('content')
<section class="section-creative" style="padding: 60px 0;">
    <div class="container">
        @role('admin')
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Header -->
                <div class="text-center mb-5">
                    <div class="icon-creative primary mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h1 class="display-4 fw-black mb-3">
                        Создание новой роли
                    </h1>
                    <p class="lead fw-bold">Заполните форму для создания новой роли в системе</p>
                </div>

                <!-- Alerts -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border: 1px solid var(--success);">
                        <i class="bi bi-check-circle me-2"></i>{{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; border: 1px solid #ef4444;">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Ошибка!</strong> Пожалуйста, исправьте следующие ошибки:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="card-creative p-5">
                    <form method="post" action="{{route('roles.store')}}">
                        @csrf

                        <!-- Role Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold mb-3" style="font-size: 1.1rem;">
                                <i class="bi bi-tag me-2" style="color: var(--primary);"></i>
                                Название роли
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="name"
                                name="name"
                                placeholder="Введите название роли"
                                style="border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 16px; font-weight: 500;"
                                value="{{ old('name') }}"
                                required
                            >
                            <small class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Название должно быть уникальным и понятным
                            </small>
                        </div>

                        <!-- Permissions Section -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3" style="font-size: 1.1rem;">
                                <i class="bi bi-shield-check me-2" style="color: var(--primary);"></i>
                                Права доступа
                            </label>
                            <p class="text-muted mb-4">
                                Выберите права доступа для этой роли. Вы можете выбрать несколько прав.
                            </p>

                            @if(count($permissions) > 0)
                                <div class="card-creative p-4" style="border: 1px solid var(--border-color);">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($permissions as $permission)
                                            <li class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-bottom-color: #e0e0e0 !important;">
                                                <div class="form-check d-flex align-items-center">
                                                    <input
                                                        class="form-check-input me-3"
                                                        type="checkbox"
                                                        value="{{$permission->id}}"
                                                        name="permissions[]"
                                                        id="permission{{$permission->id}}"
                                                        style="width: 22px; height: 22px; cursor: pointer; flex-shrink: 0;"
                                                    >
                                                    <label
                                                        class="form-check-label fw-bold flex-grow-1"
                                                        for="permission{{$permission->id}}"
                                                        style="cursor: pointer; font-size: 1rem;"
                                                    >
                                                        <i class="bi bi-check-square me-2" style="color: var(--primary);"></i>
                                                        {{$permission->name}}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="alert alert-info" style="border-radius: 12px; border: 1px solid #06b6d4;">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Нет доступных прав доступа. Создайте права доступа перед созданием роли.
                                </div>
                            @endif
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4" style="border-top: 1px solid var(--border-color);">
                            <a href="{{ route('admin.page') }}" class="btn btn-outline-secondary" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                                <i class="bi bi-arrow-left me-2"></i>Отмена
                            </a>
                            <button type="submit" class="btn btn-creative">
                                <i class="bi bi-check-circle me-2"></i>Создать роль
                            </button>
                        </div>
                    </form>
                </div>
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
    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .form-check-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
    }
    .form-check:hover {
        transform: translateX(4px);
        transition: transform 0.2s ease;
    }
    .form-check input:checked ~ label {
        color: var(--primary);
    }
    .list-unstyled li {
        transition: all 0.2s ease;
    }
    .list-unstyled li:hover {
        background: rgba(37, 99, 235, 0.03);
        border-radius: 12px;
        padding-left: 8px;
        margin-left: -8px;
    }
</style>
@endsection
