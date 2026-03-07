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

        <!-- Roles Content -->
        <div class="card-creative p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-black mb-0">
                    <i class="bi bi-people me-2" style="color: var(--primary);"></i>
                    Управление ролями
                </h2>
                <a href="{{ route('roles.create') }}" class="btn btn-creative">
                    <i class="bi bi-plus-circle me-2"></i>Добавить роли
                </a>
            </div>
            <p class="text-muted mb-4">
                Просмотр и управление ролями в системе. Вы можете назначать роли пользователям и настраивать права доступа.
            </p>
            <div class="row g-4">
                @foreach($roles as $role)
                    <div class="col-md-4 col-lg-3">
                        <div class="card-creative p-4 text-center h-100" style="border: 1px solid var(--border-color);">
                            <div class="icon-creative primary mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2.5rem;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5 class="fw-black mb-3">{{ $role->name }}</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-creative btn-sm">
                                    <i class="bi bi-pencil me-2"></i>Редактировать
                                </a>
                                <button
                                    type="button"
                                    class="btn btn-outline-danger w-100 btn-sm"
                                    style="border-width: 1px; border-radius: 12px; font-weight: 600;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteRoleModal"
                                    data-role-id="{{ $role->id }}"
                                    data-role-name="{{ $role->name }}"
                                >
                                    <i class="bi bi-trash me-2"></i>Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
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
});
</script>

@endsection
