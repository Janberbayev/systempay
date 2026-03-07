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

        <!-- Users Content -->
            <div class="card-creative p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-black mb-0">
                        <i class="bi bi-person-check me-2" style="color: var(--primary);"></i>
                        Управление пользователями
                    </h2>
                    <button class="btn btn-creative-secondary">
                        <i class="bi bi-plus-circle me-2"></i>Добавить пользователя
                    </button>
                </div>
                <p class="text-muted mb-4">
                    Просмотр и управление пользователями системы. Вы можете редактировать профили пользователей, назначать роли и управлять правами доступа.
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: var(--bg-card-hover);">
                        <tr>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">ID</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Имя</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Email</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Phone</th>
                            <th class="fw-bold" style="border-bottom: 1px solid var(--border-color);">Роль</th>
                            <th class="fw-bold text-center" style="border-bottom: 1px solid var(--border-color);">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if($user->roles->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($user->roles as $role)
                                                <span class="badge-creative" style="background: rgba(4, 120, 87, 0.1); color: #047857; border-color: rgba(4, 120, 87, 0.3); padding: 6px 12px; border-radius: 8px; font-weight: 600;">
                                                <i class="bi bi-shield-check me-1"></i>{{ $role->name }}
                                            </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">Нет ролей</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-action-edit">
                                            <i class="bi bi-pencil me-1"></i>Редактировать
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email }}"
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

    <!-- Delete User Confirmation Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-creative" style="border: none;">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem; background: rgba(220, 53, 69, 0.1); border-color: #dc3545;">
                        <i class="bi bi-exclamation-triangle" style="color: #dc3545;"></i>
                    </div>
                    <h5 class="modal-title fw-black" id="deleteUserModalLabel">
                        Подтверждение удаления пользователя
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="lead mb-3">
                        Вы уверены, что хотите удалить пользователя <strong id="userNameToDelete"></strong>?
                    </p>
                    <div class="card-creative p-3 mb-3" style="background: rgba(107, 114, 128, 0.08); border: 1px solid rgba(107, 114, 128, 0.25);">
                        <p class="mb-1"><strong>Email:</strong> <span id="userEmailToDelete"></span></p>
                    </div>
                    <div class="alert alert-warning mb-0" style="border-radius: 12px; border: 1px solid var(--warning);">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Внимание!</strong> Это действие нельзя отменить. Все данные пользователя будут удалены навсегда. Пользователи с ролью администратора не могут быть удалены.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <form id="deleteUserForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-x-circle me-2"></i>Отмена
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="confirmDeleteUserBtn" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                        <i class="bi bi-trash me-2"></i>Да, удалить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteUserModal = document.getElementById('deleteUserModal');
            const deleteUserForm = document.getElementById('deleteUserForm');
            const userNameElement = document.getElementById('userNameToDelete');
            const userEmailElement = document.getElementById('userEmailToDelete');
            const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');

            if (deleteUserModal) {
                deleteUserModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-user-id');
                    const userName = button.getAttribute('data-user-name');
                    const userEmail = button.getAttribute('data-user-email');

                    userNameElement.textContent = userName;
                    userEmailElement.textContent = userEmail;
                    deleteUserForm.action = '{{ route("users.destroy", ":id") }}'.replace(':id', userId);
                });

                confirmDeleteUserBtn.addEventListener('click', function() {
                    deleteUserForm.submit();
                });
            }
        });
    </script>

@endsection
