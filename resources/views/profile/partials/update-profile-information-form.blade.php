<header class="mb-4">
    <h2 class="fw-black mb-2">
        <i class="bi bi-person me-2" style="color: var(--primary);"></i>
        {{ __('Profile Information') }}
    </h2>
    <p class="text-muted mb-0">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-4">
        <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
        <input 
            type="text" 
            class="form-control form-control-lg" 
            id="name" 
            name="name" 
            value="{{ old('name', $user->name) }}" 
            required 
            autofocus 
            autocomplete="name"
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('name')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
        <input 
            type="email" 
            class="form-control form-control-lg" 
            id="email" 
            name="email" 
            value="{{ old('email', $user->email) }}" 
            required 
            autocomplete="username"
            style="border-width: 3px; border-color: #2d3436; border-radius: 12px;"
        >
        @error('email')
            <div class="text-danger mt-2 fw-bold">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 p-3 rounded-3" style="background: #fff3cd; border: 2px solid #ffc107;">
                <p class="mb-2 fw-bold">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ __('Your email address is unverified.') }}
                </p>
                <button form="send-verification" class="btn btn-sm btn-creative-accent">
                    {{ __('Click here to re-send the verification email.') }}
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 mb-0 fw-bold text-success">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-creative">
            <i class="bi bi-check-circle me-2"></i>{{ __('Save') }}
        </button>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success mb-0 py-2 px-3 fw-bold" role="alert" style="border-width: 2px; border-radius: 12px;">
                <i class="bi bi-check-circle me-2"></i>{{ __('Saved.') }}
            </div>
        @endif
    </div>
</form>
