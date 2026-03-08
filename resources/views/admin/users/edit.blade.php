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
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h1 class="display-4 fw-black mb-3">
                        Редактирование пользователя
                    </h1>
                    <p class="lead fw-bold">Измените информацию о пользователе и назначьте роль</p>
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

                <!-- Current User Info -->
                <div class="card-creative p-4 mb-4" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(59, 130, 246, 0.05)); border: 1px solid var(--border-color);">
                    <div class="d-flex align-items-center">
                        <div class="icon-creative primary me-4" style="width: 80px; height: 80px; font-size: 2.5rem;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="fw-black mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-2">
                                <i class="bi bi-envelope me-2"></i>{{ $user->email }}
                            </p>
                            <p class="text-muted mb-0">
                                <i class="bi bi-calendar me-2"></i>
                                Зарегистрирован: {{ $user->created_at->format('d.m.Y') }}
                            </p>
                            @if($user->roles->count() > 0)
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($user->roles as $role)
                                        <span class="badge-creative" style="background: rgba(37, 99, 235, 0.1); color: var(--primary); border-color: rgba(37, 99, 235, 0.2); padding: 4px 10px; border-radius: 8px; font-weight: 600;">
                                            <i class="bi bi-shield-check me-1"></i>{{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card-creative p-5">
                    <form method="post" action="{{route('users.update', $user->id)}}">
                        @csrf
                        @method('PUT')

                        <!-- User Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold mb-3" style="font-size: 1.1rem;">
                                <i class="bi bi-person me-2" style="color: var(--primary);"></i>
                                Имя пользователя
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="name"
                                name="name"
                                placeholder="Введите имя пользователя"
                                style="border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 16px; font-weight: 500;"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                            <small class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Введите полное имя пользователя
                            </small>
                        </div>

                        <!-- Email (Read-only) -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold mb-3" style="font-size: 1.1rem;">
                                <i class="bi bi-envelope me-2" style="color: var(--primary);"></i>
                                Email адрес
                            </label>
                            <input
                                type="email"
                                class="form-control form-control-lg"
                                id="email"
                                value="{{ $user->email }}"
                                disabled
                                style="border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 16px; font-weight: 500; background: var(--bg-light);"
                            >
                            <small class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Email адрес нельзя изменить
                            </small>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label for="role_id" class="form-label fw-bold mb-3" style="font-size: 1.1rem;">
                                <i class="bi bi-shield-check me-2" style="color: var(--primary);"></i>
                                Роль пользователя
                            </label>
                            <p class="text-muted mb-3">
                                Выберите роль для этого пользователя. Роль определяет права доступа в системе.
                            </p>
                            <div style="position: relative; width: 100%;">
                                <select
                                    name="role_id"
                                    id="role_id"
                                    class="form-select form-select-lg"
                                    style="border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 16px; font-weight: 500; width: 100%; max-width: 100%; box-sizing: border-box;"
                                    required
                                >
                                    <option value="">-- Выберите роль --</option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{$role->id}}"
                                            @if($user->hasRole($role->name)) selected @endif
                                        >
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <small class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Пользователь может иметь только одну роль
                            </small>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-4" style="border-top: 1px solid var(--border-color);">
                            <a href="{{ route('admin.page') }}" class="btn btn-outline-secondary" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                                <i class="bi bi-arrow-left me-2"></i>Отмена
                            </a>
                            <div class="d-flex gap-3">
                                <a href="{{ route('admin.page') }}" class="btn btn-outline-danger" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                                    <i class="bi bi-x-circle me-2"></i>Отменить изменения
                                </a>
                                <button type="submit" class="btn btn-creative">
                                    <i class="bi bi-check-circle me-2"></i>Сохранить изменения
                                </button>
                            </div>
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
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.15);
    }
    
    #role_id {
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }
    
    /* Ограничиваем ширину выпадающего списка */
    #role_id option {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection
