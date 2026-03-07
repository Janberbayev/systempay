@extends('layout.app')

@section('content')

    <!-- ROLES -->
    <section id="roles" class="section-creative" style="background: white;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-3 fw-black mb-3">Две роли, одна платформа</h2>
                <p class="lead fw-bold">Выберите свою роль и начните работу</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="role-card-creative h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-creative primary me-3" style="width: 64px; height: 64px; font-size: 1.8rem;">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div>
                                <h4 class="fw-black mb-0">Заказчик</h4>
                                <small class="fw-bold">Для бизнеса и стартапов</small>
                            </div>
                        </div>
                        <p class="mb-4">
                            Размещайте задачи, выбирайте исполнителей по рейтингу и портфолио,
                            контролируйте ход работ через этапы.
                        </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                <strong>Безопасная предоплата через эскроу</strong>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                <strong>Детальная аналитика и отчёты</strong>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--primary);"></i>
                                <strong>Встроенный чат и файлообмен</strong>
                            </li>
                        </ul>
                        @auth
                            @can('add projects')
                                <a href="{{route('add-project')}}" type="button" class="btn btn-creative w-100">
                                    Создать проект
                                </a>
                            @endcan
                        @endauth
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="role-card-creative h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-creative secondary me-3" style="width: 64px; height: 64px; font-size: 1.8rem;">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div>
                                <h4 class="fw-black mb-0">Исполнитель</h4>
                                <small class="fw-bold">Для фрилансеров и команд</small>
                            </div>
                        </div>
                        <p class="mb-4">
                            Получайте доступ к качественным проектам, выстраивайте репутацию
                            и защищайте свои интересы.
                        </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--secondary);"></i>
                                <strong>Гарантированная оплата после сдачи</strong>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--secondary);"></i>
                                <strong>Гибкая настройка профиля</strong>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-check-circle-fill me-2" style="color: var(--secondary);"></i>
                                <strong>Рейтинг и отзывы</strong>
                            </li>
                        </ul>
                        @auth
                            @can('add projects')
                                <a href="{{route('add-ads')}}" class="btn btn-creative-secondary w-100">
                                    Создать профиль
                                </a>
                            @endcan
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

