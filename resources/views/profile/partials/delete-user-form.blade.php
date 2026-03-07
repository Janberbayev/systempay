<header class="mb-4">
    <h2 class="fw-black mb-2">
        <i class="bi bi-exclamation-triangle me-2" style="color: #dc3545;"></i>
        {{ __('Delete Account') }}
    </h2>
    <p class="text-muted mb-4">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>
</header>

<div class="alert alert-warning mb-4" style="border-width: 3px; border-color: #ffc107; border-radius: 16px; background: #fff3cd;">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <strong>Внимание!</strong> Это действие необратимо. Все ваши данные будут удалены навсегда.
</div>

<form method="post" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <div class="mb-4">
        <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
        <input
            type="password"
            class="form-control form-control-lg"
            id="password"
            name="password"
            placeholder="{{ __('Enter your password to confirm') }}"
            required
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('password', 'userDeletion')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end gap-3">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-width: 3px; border-radius: 16px; font-weight: 700;">
            <i class="bi bi-x-circle me-2"></i>{{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-danger" style="border-width: 3px; border-color: #2d3436; border-radius: 16px; font-weight: 700; box-shadow: 4px 4px 0px rgba(45, 52, 54, 0.2);">
            <i class="bi bi-trash me-2"></i>{{ __('Delete Account') }}
        </button>
    </div>
</form>
