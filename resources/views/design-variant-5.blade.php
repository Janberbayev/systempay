<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LP3 Escrow — Серо‑зелёная тема</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --gray-50: #f8fafc;
            --gray-100: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
            --green-500: #22c55e;
            --green-600: #16a34a;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--gray-100);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--gray-900);
        }

        .navbar-brand span {
            color: var(--green-600);
        }

        .hero-gray-green {
            min-height: 85vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top left, #e5f9f0, #f9fafb);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.08);
            color: var(--green-600);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .hero-subtitle {
            color: #6b7280;
        }

        .btn-green {
            background: var(--green-600);
            border-color: var(--green-600);
        }

        .btn-green:hover {
            background: #15803d;
            border-color: #15803d;
        }

        .btn-outline-green {
            border-color: var(--green-600);
            color: var(--green-600);
        }

        .btn-outline-green:hover {
            background: var(--green-600);
            color: #ffffff;
        }

        .role-card {
            border-radius: 1rem;
            border: 1px solid var(--gray-100);
            background: #ffffff;
            transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease;
        }

        .role-card:hover {
            border-color: rgba(22, 163, 74, 0.35);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            transform: translateY(-4px);
        }

        .role-icon {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            background: rgba(22, 163, 74, 0.12);
            color: var(--green-600);
        }

        .section-title {
            font-size: 1.9rem;
            font-weight: 700;
        }

        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background: var(--green-600);
            color: #ffffff;
        }

        .step-card {
            border-radius: 1rem;
            border: 1px solid var(--gray-100);
            background: #ffffff;
            height: 100%;
        }

        .stat-number {
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--green-600);
        }

        footer {
            background: #111827;
            color: #9ca3af;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-1" href="#">
            <span>LP3</span> Escrow
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar5">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar5">
            <ul class="navbar-nav mb-2 mb-lg-0 me-lg-4">
                <li class="nav-item">
                    <a class="nav-link" href="#how">Как это работает</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#roles">Роли</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#benefits">Преимущества</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-green" type="button">Войти</button>
                <button class="btn btn-green" type="button">Регистрация</button>
            </div>
        </div>
    </div>
</nav>

<section class="hero-gray-green">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge mb-3">
                    <span class="rounded-circle bg-white" style="width: 8px; height: 8px;"></span>
                    Эскроу-сервис для профессионалов
                </div>
                <h1 class="hero-title mb-3">
                    Сбалансированный серо‑зелёный интерфейс для безопасных сделок
                </h1>
                <p class="hero-subtitle mb-4">
                    Современный лаконичный дизайн с упором на доверие: спокойные серые оттенки и зелёные акценты,
                    подчёркивающие надёжность и успех.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <button class="btn btn-green btn-lg" type="button">
                        Я заказчик
                    </button>
                    <button class="btn btn-outline-secondary btn-lg" type="button">
                        Я исполнитель
                    </button>
                </div>
                <div class="d-flex flex-wrap gap-4 small text-muted">
                    <div>
                        <div class="stat-number">12 500+</div>
                        завершённых сделок
                    </div>
                    <div>
                        <div class="stat-number">4.9</div>
                        средний рейтинг исполнителей
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Быстрый старт</h5>
                        <p class="small text-muted mb-4">
                            Укажите свою роль и кратко опишите задачу или специализацию — система подберёт
                            оптимальные предложения.
                        </p>
                        <div class="mb-3">
                            <label class="form-label">Кто вы?</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="role5" id="role5-customer" checked>
                                <label class="btn btn-outline-green" for="role5-customer">Заказчик</label>

                                <input type="radio" class="btn-check" name="role5" id="role5-performer">
                                <label class="btn btn-outline-green" for="role5-performer">Исполнитель</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="quickInput5" class="form-label">Кратко опишите задачу или специализацию</label>
                            <textarea id="quickInput5" class="form-control" rows="3"
                                      placeholder="Например: Разработка CRM / Backend-разработчик, Laravel, REST API"></textarea>
                        </div>
                        <button class="btn btn-green w-100">
                            Подобрать варианты
                        </button>
                        <p class="text-muted small mt-3 mb-0">
                            Нажимая кнопку, вы соглашаетесь с условиями сервиса и политикой конфиденциальности.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="roles" class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0">Роли на платформе</h2>
            <span class="text-muted small">Чёткое разделение ответственности</span>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="role-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon me-3">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Заказчик</h5>
                            <small class="text-muted">Компания, команда или частное лицо</small>
                        </div>
                    </div>
                    <p class="small text-muted mb-3">
                        Формируйте понятное ТЗ, сравнивайте предложения исполнителей, фиксируйте этапы и
                        контролируйте сроки с помощью встроенных инструментов.
                    </p>
                    <ul class="list-unstyled small mb-4">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Резервирование бюджета на эскроу-счёте
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Отчёты по затратам и срокам
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            История коммуникаций и файлов
                        </li>
                    </ul>
                    <button class="btn btn-outline-secondary w-100">
                        Создать первый проект
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="role-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon me-3">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Исполнитель</h5>
                            <small class="text-muted">Фрилансер, агентство или продуктовая команда</small>
                        </div>
                    </div>
                    <p class="small text-muted mb-3">
                        Получайте доступ к соответствующим вашей специализации проектам, выстраивайте
                        репутацию и защищайте свою работу прозрачными условиями.
                    </p>
                    <ul class="list-unstyled small mb-4">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гарантированная оплата после сдачи этапов
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гибкая настройка ставок и графика
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Система рейтинга и отзывов
                        </li>
                    </ul>
                    <button class="btn btn-outline-secondary w-100">
                        Создать профиль исполнителя
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="how" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-2">Как это работает</h2>
            <p class="text-muted small mb-0">
                Простая схема с понятными этапами для обеих сторон.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="step-card p-4">
                    <div class="step-badge mb-3">1</div>
                    <h6 class="mb-2">Формирование задачи</h6>
                    <p class="small text-muted mb-0">
                        Заказчик описывает задачу, бюджет и сроки. Публикует проект и получает
                        отклики исполнителей или прямые приглашения.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card p-4">
                    <div class="step-badge mb-3">2</div>
                    <h6 class="mb-2">Резервирование средств и работа</h6>
                    <p class="small text-muted mb-0">
                        Бюджет сделки резервируется на эскроу-счёте. Исполнитель выполняет
                        работу по согласованным этапам.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card p-4">
                    <div class="step-badge mb-3">3</div>
                    <h6 class="mb-2">Приёмка и оплата</h6>
                    <p class="small text-muted mb-0">
                        После подтверждения результата заказчиком средства автоматически
                        переводятся исполнителю. Обе стороны оставляют отзыв.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="benefits" class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title mb-3">Почему серо‑зелёная тема?</h2>
                <p class="small text-muted mb-3">
                    Серые оттенки создают ощущение стабильности и серьёзности, а зелёные акценты
                    ассоциируются с ростом, безопасностью и финансовым успехом. Такой интерфейс хорошо
                    подходит как для B2B, так и для B2C-аудитории.
                </p>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2">
                        <i class="bi bi-dot text-success me-1"></i>
                        Ненавязчивая цветовая палитра, удобная для долгой работы
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-dot text-success me-1"></i>
                        Подчёркивание ключевых действий зелёными CTA‑кнопками
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-dot text-success me-1"></i>
                        Лёгкая интеграция в корпоративный стиль
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="p-4 rounded-3 border bg-white">
                    <h6 class="mb-3">Краткая сводка</h6>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Нагруженность интерфейса</span>
                        <span class="fw-semibold text-success">Низкая</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 25%;"></div>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Визуальный акцент на действия</span>
                        <span class="fw-semibold text-success">Высокий</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 80%;"></div>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Уместность для корпоративных клиентов</span>
                        <span class="fw-semibold text-success">Очень высокая</span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 90%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h2 class="section-title mb-2">Готовы протестировать серо‑зелёный вариант?</h2>
                <p class="small text-muted mb-0">
                    Создайте первый проект или профиль исполнителя — интерфейс останется спокойным,
                    а ключевые действия будут всегда на виду.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-green me-2 mb-2">
                    Регистрация заказчика
                </button>
                <button class="btn btn-outline-green mb-2">
                    Регистрация исполнителя
                </button>
            </div>
        </div>
    </div>
</section>

<footer class="py-4">
    <div class="container">
        <div class="row gy-3 align-items-center">
            <div class="col-md-4 small">
                © 2026 LP3 Escrow. Все права защищены.
            </div>
            <div class="col-md-4 small text-md-center">
                <a href="#" class="text-decoration-none text-secondary me-3">Пользовательское соглашение</a>
                <a href="#" class="text-decoration-none text-secondary">Политика конфиденциальности</a>
            </div>
            <div class="col-md-4 small text-md-end">
                support@lp3-escrow.com
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

