@extends('layout.app')

@section('content')

    <!-- HERO -->
    <section class="hero-creative position-relative">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="mb-4">
                    <span class="badge-creative">
                        🚀 Эскроу нового уровня
                    </span>
                    </div>
                    <h1 class="hero-title-creative mb-4">
                        Платформа эскроу для безопасных сделок
                    </h1>
                    <p class="lead mb-5" style="font-weight: 500; color: var(--text-secondary);">
                        Создавайте проекты, находите таланты и проводите безопасные сделки
                        с гарантией оплаты через эскroу-счёт. Всё просто и прозрачно!
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        <button class="btn btn-creative btn-lg">
                            <i class="bi bi-briefcase me-2"></i>Я заказчик
                        </button>
                        <button class="btn btn-creative-secondary btn-lg">
                            <i class="bi bi-person-check me-2"></i>Я исполнитель
                        </button>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        <a href="{{ route('login') }}" class="btn btn-creative-accent btn-sm fw-bold" style="border-radius: 999px;">
                            Войти
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-creative btn-sm fw-bold" style="border-radius: 999px;">
                            Регистрация
                        </a>
                    </div>
                    <div class="row g-4">
                        <div class="col-4">
                            <div class="stat-number-creative">12K+</div>
                            <small class="fw-bold" style="color: var(--text-secondary);">Сделок</small>
                        </div>
                        <div class="col-4">
                            <div class="stat-number-creative" style="color: var(--accent-blue);">4.9</div>
                            <small class="fw-bold" style="color: var(--text-secondary);">Рейтинг</small>
                        </div>
                        <div class="col-4">
                            <div class="stat-number-creative" style="color: var(--accent-purple);">98%</div>
                            <small class="fw-bold" style="color: var(--text-secondary);">Успех</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-creative p-5">
                        <h4 class="mb-4 fw-bold">Быстрый старт</h4>
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: var(--text-primary);">Выберите роль</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="role4" id="customer4" checked>
                                <label class="btn btn-outline-primary rounded-start-pill fw-bold" for="customer4" style="border-width: 1px; border-color: var(--border-color); color: var(--text-primary); background: var(--bg-card);">Заказчик</label>
                                <input type="radio" class="btn-check" name="role4" id="performer4">
                                <label class="btn btn-outline-primary rounded-end-pill fw-bold" for="performer4" style="border-width: 1px; border-color: var(--border-color); color: var(--text-primary); background: var(--bg-card);">Исполнитель</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: var(--text-primary);">Опишите задачу</label>
                            <textarea class="form-control rounded-3" rows="4"
                                      placeholder="Например: Нужен дизайнер для создания логотипа"></textarea>
                        </div>
                        <button class="btn btn-creative-accent w-100">
                            Начать проект 🎉
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="section-creative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-3 fw-black mb-3">Почему выбирают нас</h2>
                <p class="lead fw-bold">Всё необходимое для успешного сотрудничества</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="icon-creative primary mb-4 mx-auto">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-center">Безопасность</h5>
                    <p class="text-center">
                        Эскроу-счёт защищает обе стороны. Средства резервируются и переводятся только после
                        успешного завершения работы.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="icon-creative secondary mb-4 mx-auto">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-center">Прозрачность</h5>
                    <p class="text-center">
                        Полный контроль над проектом. Отслеживайте прогресс, общайтесь в чате и получайте
                        уведомления о каждом этапе.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="icon-creative accent mb-4 mx-auto">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-center">Скорость</h5>
                    <p class="text-center">
                        Быстрый подбор исполнителей, моментальные уведомления и автоматизированные выплаты
                        без задержек.
                    </p>
                </div>
            </div>
        </div>
    </section>

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
                        <button class="btn btn-creative w-100">
                            Создать проект
                        </button>
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
                        <button class="btn btn-creative-secondary w-100">
                            Создать профиль
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how" class="section-creative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-3 fw-black mb-3">Как это работает</h2>
                <p class="lead fw-bold">Три простых шага к успешной сделке</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100 text-center">
                        <div class="icon-creative primary mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                            <span class="fw-black">1</span>
                        </div>
                        <h5 class="fw-black mb-3">Создайте проект</h5>
                        <p>
                            Опишите задачу, укажите бюджет и сроки. Система автоматически подберёт
                            подходящих исполнителей.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100 text-center">
                        <div class="icon-creative secondary mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                            <span class="fw-black">2</span>
                        </div>
                        <h5 class="fw-black mb-3">Выберите исполнителя</h5>
                        <p>
                            Просмотрите предложения, портфолио и рейтинги. Средства автоматически
                            резервируются на эскроу-счёте.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100 text-center">
                        <div class="icon-creative accent mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem;">
                            <span class="fw-black">3</span>
                        </div>
                        <h5 class="fw-black mb-3">Получите результат</h5>
                        <p>
                            После подтверждения работы средства автоматически переводятся исполнителю.
                            Обе стороны оставляют отзывы.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECURITY -->
    <section id="security" class="section-creative" style="background: #fffdf7;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-3 fw-black mb-3">Безопасность сделок</h2>
                <p class="lead fw-bold">Тот же уровень доверия, что и в банковских приложениях</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-creative primary me-3" style="width: 56px; height: 56px; font-size: 1.8rem;">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h5 class="fw-black mb-0">Эскроу‑счёт</h5>
                        </div>
                        <p>
                            Средства резервируются на отдельном эскроу‑счёте и перечисляются исполнителю
                            только после подтверждения результата заказчиком.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-creative secondary me-3" style="width: 56px; height: 56px; font-size: 1.8rem;">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h5 class="fw-black mb-0">Прозрачные условия</h5>
                        </div>
                        <p>
                            Все этапы сделки и условия оплаты зафиксированы в кабинете. Можно
                            в любой момент скачать историю операций и переписку.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-creative p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-creative accent me-3" style="width: 56px; height: 56px; font-size: 1.8rem;">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                            <h5 class="fw-black mb-0">Арбитраж</h5>
                        </div>
                        <p>
                            В спорных ситуациях подключается служба арбитража. Решения принимаются
                            на основании фактов и зафиксированных этапов.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-creative" style="background: linear-gradient(135deg, rgba(16, 163, 127, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);">
        <div class="container text-center">
            <h2 class="display-3 fw-black mb-4" style="color: var(--text-primary);">Готовы начать?</h2>
            <p class="lead mb-5 fw-bold" style="color: var(--text-secondary);">
                Присоединяйтесь к тысячам заказчиков и исполнителей, которые уже используют SystemPay
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-creative btn-lg">
                    Регистрация заказчика
                </a>
                <a href="{{ route('register') }}" class="btn btn-creative-secondary btn-lg">
                    Регистрация исполнителя
                </a>
            </div>
        </div>
    </section>
@endsection
