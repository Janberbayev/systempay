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

        <!-- General Content -->
        <div class="card-creative p-4">
            <h2 class="fw-black mb-4">
                <i class="bi bi-grid me-2" style="color: var(--primary);"></i>
                Общие данные
            </h2>
            <p class="text-muted mb-4">
                Сводная информация по системе. Здесь можно разместить общую статистику и настройки.
            </p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-creative p-4 text-center" style="border: 1px solid var(--border-color);">
                        <div class="icon-creative primary mx-auto mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Роли</h5>
                        <p class="text-muted mb-0 small">{{ $roles->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 text-center" style="border: 1px solid var(--border-color);">
                        <div class="icon-creative secondary mx-auto mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Пользователи</h5>
                        <p class="text-muted mb-0 small">{{ $users->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 text-center" style="border: 1px solid var(--border-color);">
                        <div class="icon-creative accent mx-auto mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Объявления</h5>
                        <p class="text-muted mb-0 small">{{ $adverts->count() }} из них в ожидании {{ $adverts->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 text-center" style="border: 1px solid var(--border-color);">
                        <div class="icon-creative accent mx-auto mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Проекты</h5>
                        <p class="text-muted mb-0 small">{{ $projects->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 text-center" style="border: 1px solid var(--border-color);">
                        <div class="icon-creative accent mx-auto mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Сделки</h5>
                        <p class="text-muted mb-0 small">Активна</p>
                    </div>
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

<!-- Delete Role Confirmation Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-creative" style="border: none;">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                <div class="icon-creative primary me-3" style="width: 60px; height: 60px; font-size: 2rem;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5 class="modal-title fw-black" id="deleteRoleModalLabel">
                    Подтверждение удаления
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="lead mb-3">
                    Вы уверены, что хотите удалить роль <strong id="roleNameToDelete"></strong>?
                </p>
                <div class="alert alert-warning mb-0" style="border-radius: 12px; border: 1px solid var(--warning);">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Внимание!</strong> Это действие нельзя отменить. Все пользователи с этой ролью потеряют соответствующие права доступа.
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                <form id="deleteRoleForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                    <i class="bi bi-x-circle me-2"></i>Отмена
                </button>
                <button type="button" class="btn btn-outline-danger" id="confirmDeleteBtn" style="border-width: 1px; border-radius: 12px; font-weight: 600; padding: 12px 24px;">
                    <i class="bi bi-trash me-2"></i>Да, удалить
                </button>
            </div>
        </div>
    </div>
</div>

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
    const deleteRoleModal = document.getElementById('deleteRoleModal');
    const deleteRoleForm = document.getElementById('deleteRoleForm');
    const roleNameElement = document.getElementById('roleNameToDelete');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    if (deleteRoleModal) {
        deleteRoleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const roleId = button.getAttribute('data-role-id');
            const roleName = button.getAttribute('data-role-name');

            roleNameElement.textContent = roleName;
            deleteRoleForm.action = '{{ route("roles.destroy", ":id") }}'.replace(':id', roleId);
        });

        confirmDeleteBtn.addEventListener('click', function() {
            deleteRoleForm.submit();
        });
    }

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
