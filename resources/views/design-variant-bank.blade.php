<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LP3 Escrow — Платформа в стиле банковского приложения</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            /* Осветлённая банковская палитра с серыми оттенками */
            --bank-bg: #f3f4f6;
            --bank-card: #ffffff;
            --bank-surface: #f9fafb;
            --bank-border: #d1d5db;
            --bank-primary: #16a34a;
            --bank-primary-soft: rgba(22, 163, 74, 0.08);
            --bank-text-main: #111827;
            --bank-text-muted: #6b7280;
            --bank-accent: #0284c7;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #e5f3ff 0, #f3f4f6 40%, #e5e7eb 100%);
            color: var(--bank-text-main);
        }

        .navbar-bank {
            background: rgba(249, 250, 251, 0.96);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--bank-border);
        }

        .navbar-brand span {
            font-weight: 700;
            color: var(--bank-primary);
        }

        .nav-link {
            color: var(--bank-text-muted);
        }

        .nav-link.active,
        .nav-link:hover {
            color: var(--bank-text-main);
        }

        .btn-bank-primary {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
            color: #0b1120;
            font-weight: 600;
            border-radius: 999px;
            padding-inline: 1.5rem;
        }

        .btn-bank-primary:hover,
        .btn-bank-primary.active {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #0b1120;
            box-shadow: 0 16px 30px rgba(34, 197, 94, 0.35);
        }

        .btn-bank-outline {
            border-radius: 999px;
            border: 1px solid var(--bank-border);
            color: var(--bank-text-main);
            background: #ffffff;
        }

        .btn-bank-outline:hover,
        .btn-bank-outline.active {
            border-color: var(--bank-primary);
            color: var(--bank-primary);
            background: #ffffff;
        }

        .hero-bank {
            padding: 3.5rem 0 4.5rem;
        }

        .hero-kpi-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--bank-text-muted);
        }

        .hero-title {
            font-size: 2.6rem;
            font-weight: 800;
        }

        .hero-subtitle {
            color: var(--bank-text-muted);
            font-size: 0.95rem;
        }

        .pill-badge {
            display: inline-flex;
            gap: .4rem;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid var(--bank-border);
            font-size: 0.75rem;
            color: var(--bank-text-muted);
        }

        .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--bank-primary);
        }

        .card-dashboard {
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border-radius: 1.25rem;
            border: 1px solid var(--bank-border);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
        }

        .balance-label {
            font-size: 0.8rem;
            color: var(--bank-text-muted);
        }

        .balance-value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .chip-role {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.8rem;
            border: 1px solid rgba(55, 65, 81, 0.9);
            color: var(--bank-text-muted);
        }

        .chip-role i {
            font-size: 0.9rem;
        }

        .tx-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px dashed rgba(31, 41, 55, 0.9);
        }

        .tx-item:last-child {
            border-bottom: none;
        }

        .tx-amount {
            font-weight: 600;
        }

        .tx-amount.in {
            color: var(--bank-primary);
        }

        .tx-amount.out {
            color: var(--bank-accent);
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .role-card {
            background: var(--bank-surface);
            border-radius: 1rem;
            border: 1px solid var(--bank-border);
            padding: 1.5rem;
            height: 100%;
        }

        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            background: #ffffff;
            border: 1px solid var(--bank-border);
        }

        .timeline-step {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline-step::before {
            content: "";
            position: absolute;
            left: 0.4rem;
            top: 0.25rem;
            bottom: -0.25rem;
            border-left: 1px dashed rgba(55, 65, 81, 0.9);
        }

        .timeline-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            border: 2px solid var(--bank-primary);
            background: var(--bank-surface);
            position: absolute;
            left: 0.1rem;
            top: 0.25rem;
        }

        .timeline-step:last-child::before {
            bottom: 0.5rem;
        }

        .shield-icon {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid var(--bank-border);
            color: var(--bank-accent);
        }

        footer {
            border-top: 1px solid var(--bank-border);
            background: #ffffff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-bank sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <span>LP3</span> Escrow
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bankNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="bankNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link active" href="#dashboard">Обзор</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#roles">Роли</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#security">Безопасность</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a href="#login" class="btn btn-bank-outline btn-sm btn-auth">Войти</a>
                <a href="#register" class="btn btn-bank-primary btn-sm btn-auth">Регистрация</a>
            </div>
        </div>
    </div>
</nav>

<main class="hero-bank" id="dashboard">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="pill-badge">
                        <span class="pill-dot"></span>
                        Платформа для безопасных услуг
                    </span>
                </div>
                <h1 class="hero-title mb-3">
                    Банковский подход<br>к сделкам по оказанию услуг
                </h1>
                <p class="hero-subtitle mb-4">
                    Размещайте заказы на услуги, выбирайте исполнителей и проводите оплату через эскроу‑счёт.
                    Все этапы сделки фиксируются и отображаются так же прозрачно, как операции в интернет‑банке.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <button class="btn btn-bank-primary btn-lg">
                        Я заказчик
                    </button>
                    <button class="btn btn-bank-outline btn-lg">
                        Я исполнитель
                    </button>
                </div>

                <div class="row text-sm-start text-center g-3">
                    <div class="col-4">
                        <div class="hero-kpi-label mb-1">Активных услуг</div>
                        <div class="fw-semibold">840+</div>
                    </div>
                    <div class="col-4">
                        <div class="hero-kpi-label mb-1">Завершённых сделок</div>
                        <div class="fw-semibold text-success">12 500+</div>
                    </div>
                    <div class="col-4">
                        <div class="hero-kpi-label mb-1">Средний рейтинг</div>
                        <div class="fw-semibold text-info">4.9 / 5</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-dashboard p-4">
                    <h2 class="section-title mb-3">Популярные категории услуг</h2>
                    <p class="small text-muted mb-4">
                        Выберите категорию, чтобы посмотреть исполнителей и разместить заказ.
                    </p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="role-card h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="role-icon me-2">
                                        <i class="bi bi-code-slash"></i>
                                    </div>
                                    <div>
                                        <div class="small fw-semibold">Разработка</div>
                                        <div class="hero-kpi-label">Веб, мобильные, CRM</div>
                                    </div>
                                </div>
                                <button class="btn btn-bank-outline btn-sm w-100 mt-2">
                                    Найти исполнителя
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="role-card h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="role-icon me-2">
                                        <i class="bi bi-palette"></i>
                                    </div>
                                    <div>
                                        <div class="small fw-semibold">Дизайн</div>
                                        <div class="hero-kpi-label">UI/UX, бренд, иллюстрации</div>
                                    </div>
                                </div>
                                <button class="btn btn-bank-outline btn-sm w-100 mt-2">
                                    Найти исполнителя
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="role-card h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="role-icon me-2">
                                        <i class="bi bi-graph-up"></i>
                                    </div>
                                    <div>
                                        <div class="small fw-semibold">Маркетинг</div>
                                        <div class="hero-kpi-label">Реклама, SEO, контент</div>
                                    </div>
                                </div>
                                <button class="btn btn-bank-outline btn-sm w-100 mt-2">
                                    Найти исполнителя
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="role-card h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="role-icon me-2">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div>
                                        <div class="small fw-semibold">Консалтинг</div>
                                        <div class="hero-kpi-label">Бизнес, финансы, юр. услуги</div>
                                    </div>
                                </div>
                                <button class="btn btn-bank-outline btn-sm w-100 mt-2">
                                    Найти исполнителя
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<section id="roles" class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0">Две роли — общий контроль</h2>
            <span class="hero-kpi-label">Отдельные сценарии для заказчика и исполнителя</span>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="role-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon me-3">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <div class="small text-uppercase text-muted">Роль</div>
                            <h5 class="mb-0">Заказчик</h5>
                        </div>
                    </div>
                    <p class="small text-muted mb-3">
                        Управляйте бюджетом как в онлайн‑банке: лимиты по проектам, расписание
                        выплат, автоматическое резервирование и возвраты.
                    </p>
                    <ul class="list-unstyled small mb-3">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Лимиты и уведомления по операциям
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Подпись ключевых действий двухфакторной аутентификацией
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Финансовые отчёты по проектам в формате для бухгалтерии
                        </li>
                    </ul>
                    <button class="btn btn-bank-primary w-100">
                        Создать проект как заказчик
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="role-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon me-3">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <div class="small text-uppercase text-muted">Роль</div>
                            <h5 class="mb-0">Исполнитель</h5>
                        </div>
                    </div>
                    <p class="small text-muted mb-3">
                        Видите ожидаемые выплаты, историю зачислений и статусы проектов.
                        Денежные потоки прозрачны и предсказуемы.
                    </p>
                    <ul class="list-unstyled small mb-3">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Календарь поступлений по этапам
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            История выплат и выгрузка в формате Excel/CSV
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Система рейтинга и лимитов по заказчикам
                        </li>
                    </ul>
                    <button class="btn btn-bank-outline w-100">
                        Создать профиль исполнителя
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="security" class="py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="shield-icon mb-3">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h2 class="section-title mb-3">Банковские стандарты безопасности</h2>
                <p class="small text-muted mb-3">
                    Все операции с эскроу‑счётом проходят по зафиксированным сценариям: резервирование,
                    поэтапное списание, возвраты и арбитраж. Никаких неожиданных списаний.
                </p>
                <div class="timeline-step mb-3">
                    <div class="timeline-dot"></div>
                    <h6 class="mb-1">Двухфакторная аутентификация</h6>
                    <p class="small text-muted mb-0">
                        Подтверждение входа и ключевых финансовых действий через SMS / TOTP‑коды.
                    </p>
                </div>
                <div class="timeline-step mb-3">
                    <div class="timeline-dot"></div>
                    <h6 class="mb-1">Отдельный эскроу‑баланс</h6>
                    <p class="small text-muted mb-0">
                        Средства по сделкам отделены от операционного счёта платформы.
                    </p>
                </div>
                <div class="timeline-step mb-0">
                    <div class="timeline-dot"></div>
                    <h6 class="mb-1">Журнал событий</h6>
                    <p class="small text-muted mb-0">
                        Полный лог действий по проекту и финансам, доступный для обеих сторон.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-dashboard p-4">
                    <h6 class="mb-3">Сводка рисков по аккаунту</h6>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Уровень доверия к аккаунту</span>
                        <span class="fw-semibold text-success">Высокий</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 85%;"></div>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Риск блокировки операций</span>
                        <span class="fw-semibold text-warning">Низкий</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 20%;"></div>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Прозрачность истории платежей</span>
                        <span class="fw-semibold text-info">Полная</span>
                    </div>
                    <div class="progress mb-4" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: 100%;"></div>
                    </div>
                    <p class="small text-muted mb-0">
                        В любой момент вы можете выгрузить полную выписку по эскроу‑операциям для внутреннего
                        аудита или внешних проверок.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="login" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card-dashboard p-4">
                    <h2 class="section-title mb-1">Войти в личный кабинет</h2>
                    <p class="small text-muted mb-4">
                        Используйте единый вход для роли заказчика или исполнителя.
                    </p>
                    <form>
                        <div class="mb-3">
                            <label class="form-label small text-muted">E‑mail</label>
                            <input type="email" class="form-control form-control-sm" placeholder="you@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Пароль</label>
                            <input type="password" class="form-control form-control-sm" placeholder="••••••••">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check small">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Запомнить меня
                                </label>
                            </div>
                            <a href="#" class="small text-decoration-none" style="color: var(--bank-accent);">
                                Забыли пароль?
                            </a>
                        </div>
                        <button type="button" class="btn btn-bank-primary w-100 mb-3">
                            Войти
                        </button>
                        <p class="small text-muted mb-0 text-center">
                            Нет аккаунта?
                            <a href="#register" class="text-decoration-none" style="color: var(--bank-accent);">
                                Зарегистрироваться
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="register" class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-dashboard p-4 h-100">
                    <h2 class="section-title mb-1">Регистрация заказчика</h2>
                    <p class="small text-muted mb-4">
                        Создайте аккаунт, чтобы размещать заказы на услуги, управлять бюджетом
                        и отслеживать статусы проектов в одном интерфейсе.
                    </p>
                    <form>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Название компании / имя</label>
                            <input type="text" class="form-control form-control-sm" placeholder="ООО «Пример»">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">E‑mail</label>
                            <input type="email" class="form-control form-control-sm" placeholder="you@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Пароль</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Минимум 8 символов">
                        </div>
                        <button type="button" class="btn btn-bank-primary w-100">
                            Зарегистрироваться как заказчик
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-dashboard p-4 h-100">
                    <h2 class="section-title mb-1">Регистрация исполнителя</h2>
                    <p class="small text-muted mb-4">
                        Создайте профиль исполнителя, чтобы получать заказы на услуги,
                        видеть ожидаемые выплаты и историю операций.
                    </p>
                    <form>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Имя / название команды</label>
                            <input type="text" class="form-control form-control-sm" placeholder="ИП Иванов / Studio Pixel">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Основная специализация</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Например: разработка, дизайн, маркетинг">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">E‑mail</label>
                            <input type="email" class="form-control form-control-sm" placeholder="you@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Пароль</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Минимум 8 символов">
                        </div>
                        <button type="button" class="btn btn-bank-outline w-100">
                            Зарегистрироваться как исполнитель
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 border-top border-secondary-subtle">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <h2 class="section-title mb-2">Готовы работать по банковским правилам?</h2>
                <p class="small text-muted mb-0">
                    Подключите LP3 Escrow к вашим процессам и управляйте сделками с тем же уровнем
                    контроля, что и корпоративным счетом.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-bank-primary me-2 mb-2">
                    Регистрация заказчика
                </button>
                <button class="btn btn-bank-outline mb-2">
                    Регистрация исполнителя
                </button>
            </div>
        </div>
    </div>
</section>

<footer class="py-4 text-muted bg-black bg-opacity-75">
    <div class="container">
        <div class="row gy-3 align-items-center">
            <div class="col-md-4 small">
                © 2026 LP3 Escrow. Все права защищены.
            </div>
            <div class="col-md-4 small text-md-center">
                <a href="#" class="text-decoration-none text-muted me-3">Пользовательское соглашение</a>
                <a href="#" class="text-decoration-none text-muted">Политика конфиденциальности</a>
            </div>
            <div class="col-md-4 small text-md-end">
                support@lp3-escrow.com
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.navbar-bank .nav-link');
        const authButtons = document.querySelectorAll('.navbar-bank .btn-auth');

        function setActiveNav(targetHash) {
            navLinks.forEach(link => {
                if (link.getAttribute('href') === targetHash) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                setActiveNav(this.getAttribute('href'));
            });
        });

        authButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                authButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
</body>
</html>

