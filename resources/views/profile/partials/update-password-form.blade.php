<header class="mb-4">
    <h2 class="fw-black mb-2">
        <i class="bi bi-shield-lock me-2" style="color: var(--secondary);"></i>
        {{ __('Update Password') }}
    </h2>
    <p class="text-muted mb-0">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
</header>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-4">
        <label for="update_password_current_password" class="form-label fw-bold">{{ __('Current Password') }}</label>
        <input 
            type="password" 
            class="form-control form-control-lg" 
            id="update_password_current_password" 
            name="current_password" 
            autocomplete="current-password"
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('current_password', 'updatePassword')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="update_password_password" class="form-label fw-bold">{{ __('New Password') }}</label>
        <input 
            type="password" 
            class="form-control form-control-lg" 
            id="update_password_password" 
            name="password" 
            autocomplete="new-password"
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('password', 'updatePassword')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="update_password_password_confirmation" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
        <input 
            type="password" 
            class="form-control form-control-lg" 
            id="update_password_password_confirmation" 
            name="password_confirmation" 
            autocomplete="new-password"
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('password_confirmation', 'updatePassword')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-creative-secondary">
            <i class="bi bi-check-circle me-2"></i>{{ __('Save') }}
        </button>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mb-0 py-2 px-3 fw-bold" role="alert" style="border-width: 2px; border-radius: 12px;">
                <i class="bi bi-check-circle me-2"></i>{{ __('Saved.') }}
            </div>
        @endif
    </div>
</form>
