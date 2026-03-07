@extends('layout.app')

@section('content')
<section class="section-creative" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <!-- Profile Header -->
            <div class="col-lg-8 mx-auto mb-5">
                <div class="card-creative p-4 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-creative primary me-4" style="width: 100px; height: 100px; font-size: 3rem;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h1 class="display-5 fw-black mb-2">{{ $user->name }}</h1>
                            <p class="lead mb-2">
                                <i class="bi bi-envelope me-2" style="color: var(--primary);"></i>
                                {{ $user->email }}
                            </p>
                            @if($user->roles->count() > 0)
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        <span class="badge-creative" style="background: var(--secondary); color: white; border-color: var(--secondary);">
                                            <i class="bi bi-shield-check me-1"></i>{{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mx-auto">
                <!-- Profile Information -->
                <div class="card-creative p-4 mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Account Actions -->
                <div class="card-creative p-4">
                    <h3 class="fw-black mb-4">
                        <i class="bi bi-gear me-2" style="color: var(--primary);"></i>
                        Настройки аккаунта
                    </h3>
                    <div class="d-grid gap-3">
                        <button type="button" class="btn btn-creative-secondary" data-bs-toggle="modal" data-bs-target="#passwordModal">
                            <i class="bi bi-key me-2"></i>Изменить пароль
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border-width: 3px; border-color: #dc3545; border-radius: 16px; font-weight: 700;">
                            <i class="bi bi-trash me-2"></i>Удалить аккаунт
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Password Update Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-creative" style="border: none;">
            <div class="modal-header" style="border-bottom: 3px solid #2d3436;">
                <h5 class="modal-title fw-black" id="passwordModalLabel">
                    <i class="bi bi-key me-2" style="color: var(--primary);"></i>Изменить пароль
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-creative" style="border: none;">
            <div class="modal-header" style="border-bottom: 3px solid #2d3436;">
                <h5 class="modal-title fw-black" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2" style="color: #dc3545;"></i>Удаление аккаунта
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
