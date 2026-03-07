{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--            --}}
{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}
{{--            --}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

@extends('layout.app')
@section('content')
    <!-- REGISTER -->
    <section id="register" class="section-creative" style="background: white; min-height: 100vh; display: flex; align-items: center; padding: 60px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card-creative p-5">
                        <h2 class="display-5 fw-black mb-3 text-center">Регистрация</h2>
                        <p class="text-center mb-4">
                            Используйте единый вход для роли заказчика или исполнителя.
                        </p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">ФИО</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="ФИО">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Электронная почта</label>
                                <input type="email" name="email" class="form-control rounded-3" placeholder="you@example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Номер телефона</label>
                                <input type="text" name="phone" class="form-control rounded-3" placeholder="+7__________">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Пароль</label>
                                <input type="password" name="password" id="password" class="form-control rounded-3" placeholder="Минимум 8 символов" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Подтвердить Пароль</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3" placeholder="Минимум 8 символов" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-creative w-100">
                                Зарегистрироваться
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--                <div class="col-md-6">--}}
{{--                    <div class="role-card-creative h-100">--}}
{{--                        <h4 class="fw-black mb-3">Я исполнитель</h4>--}}
{{--                        <p class="mb-4">--}}
{{--                            Получайте заказы, выстраивайте репутацию и защищайте свои интересы.--}}
{{--                        </p>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="form-label fw-bold">Имя / название команды</label>--}}
{{--                            <input type="text" class="form-control rounded-3" placeholder="ИП Иванов / Studio Pixel">--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="form-label fw-bold">Основная специализация</label>--}}
{{--                            <input type="text" class="form-control rounded-3" placeholder="Например: разработка, дизайн, маркетинг">--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="form-label fw-bold">E‑mail</label>--}}
{{--                            <input type="email" class="form-control rounded-3" placeholder="you@example.com">--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label class="form-label fw-bold">Пароль</label>--}}
{{--                            <input type="password" class="form-control rounded-3" placeholder="Минимум 8 символов">--}}
{{--                        </div>--}}
{{--                        <button type="button" class="btn btn-creative-secondary w-100">--}}
{{--                            Зарегистрироваться как исполнитель--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
@endsection
