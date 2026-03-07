{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}


@extends('layout.app')
@section('content')
    <!-- LOGIN -->
    <section id="login" class="section-creative" style="background: white; min-height: 100vh; display: flex; align-items: center; padding: 60px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card-creative p-5">
                        <h2 class="display-5 fw-black mb-3 text-center">Вход в личный кабинет</h2>
                        <p class="text-center mb-4">
                            Используйте единый вход для роли заказчика или исполнителя.
                        </p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">E‑mail</label>
                                <input type="email" name="email" class="form-control rounded-3">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Пароль</label>
                                <input type="password" name="password" class="form-control rounded-3">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMeHome">
                                    <label class="form-check-label" for="rememberMeHome">
                                        Запомнить меня
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="#" class="small fw-bold text-decoration-none" style="color: var(--secondary);">
                                    Забыли пароль?
                                </a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-creative w-100 mb-3">
                                Войти
                            </button>
                            <p class="small text-center mb-0">
                                Нет аккаунта?
                                <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--secondary);">
                                    Зарегистрироваться
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
