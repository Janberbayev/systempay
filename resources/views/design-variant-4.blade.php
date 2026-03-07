<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LP3 Escrow — Площадка заказчиков и исполнителей</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .navbar-brand span {
            font-weight: 700;
        }

        .hero-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top left, #e3f2fd, #f8f9fa);
        }

        .hero-badge {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border-radius: 50px;
            padding: 4px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .hero-title {
            font-size: 2.6rem;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            color: #6c757d;
        }

        .role-card {
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease-in-out;
        }

        .role-card:hover {
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
            transform: translateY(-4px);
        }

        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .testimonial-card {
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }

        footer {
            background: #020617;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <span class="text-primary">LP3</span> Escrow
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0 me-lg-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#how-it-works">Как это работает</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#roles">Заказчик и Исполнитель</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#security">Безопасность</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cases">Кейсы</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" type="button">Войти</button>
                <button class="btn btn-primary" type="button">Регистрация</button>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge mb-3">
                    Эскроу-сервис для безопасных сделок
                </div>
                <h1 class="hero-title mb-3">
                    Профессиональная среда для заказчиков и исполнителей
                </h1>
                <p class="hero-subtitle mb-4">
                    Размещайте задачи, выбирайте проверенных исполнителей и безопасно проводите
                    оплату через эскроу-счёт. Деньги резервируются и переводятся только после
                    успешного завершения работы.
                </p>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <button class="btn btn-primary btn-lg" type="button">
                        Я заказчик
                    </button>
                    <button class="btn btn-outline-secondary btn-lg" type="button">
                        Я исполнитель
                    </button>
                </div>

                <div class="d-flex flex-wrap gap-4 text-muted small">
                    <div>
                        <div class="stats-number text-dark">12 500+</div>
                        завершённых сделок
                    </div>
                    <div>
                        <div class="stats-number text-dark">4.9</div>
                        средний рейтинг исполнителей
                    </div>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">
                            Быстрый старт
                        </h5>
                        <p class="small text-muted mb-4">
                            Выберите свою роль, опишите задачу или профиль, и система подберёт вам
                            релевантные предложения или проекты.
                        </p>

                        <div class="mb-3">
                            <label class="form-label">Кто вы?</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="roleOptions" id="roleCustomer" checked>
                                <label class="btn btn-outline-primary" for="roleCustomer">Заказчик</label>

                                <input type="radio" class="btn-check" name="roleOptions" id="rolePerformer">
                                <label class="btn btn-outline-primary" for="rolePerformer">Исполнитель</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quickInput" class="form-label">
                                Кратко опишите задачу или специализацию
                            </label>
                            <textarea class="form-control" id="quickInput" rows="3"
                                      placeholder="Например: Разработка лендинга под ключ / Frontend-разработчик, React, Vue">
                            </textarea>
                        </div>

                        <button class="btn btn-primary w-100">
                            Начать без регистрации
                        </button>

                        <p class="text-muted small mt-3 mb-0">
                            Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности и условиями сервиса.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section id="roles" class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0">Роли на платформе</h2>
            <span class="text-muted small">Создаём прозрачные правила для обеих сторон</span>
        </div>

        <div class="row g-4">
            <!-- Заказчик -->
            <div class="col-md-6">
                <div class="role-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon bg-primary-subtle text-primary me-3">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Заказчик</h5>
                            <small class="text-muted">Бизнес, стартап, частное лицо</small>
                        </div>
                    </div>
                    <p class="text-muted small mb-3">
                        Формируйте чёткое техническое задание, выбирайте исполнителя по рейтингу и портфолио,
                        контролируйте ход работ через milestones.
                    </p>
                    <ul class="list-unstyled small mb-4">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Безопасная предоплата через эскроу-счёт
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Детальная аналитика по бюджету и срокам
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Встроенный чат и файлообмен
                        </li>
                    </ul>
                    <button class="btn btn-outline-primary w-100">
                        Создать первый проект
                    </button>
                </div>
            </div>

            <!-- Исполнитель -->
            <div class="col-md-6">
                <div class="role-card p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="role-icon bg-success-subtle text-success me-3">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Исполнитель</h5>
                            <small class="text-muted">Фрилансер, агентство, команда</small>
                        </div>
                    </div>
                    <p class="text-muted small mb-3">
                        Получайте доступ к качественным заявкам, выстраивайте репутацию, защищайте
                        свои интересы фиксированными этапами и прозрачными условиями.
                    </p>
                    <ul class="list-unstyled small mb-4">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гарантированная оплата после сдачи результата
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гибкая настройка профиля и ставок
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Рейтинг и отзывы для укрепления доверия
                        </li>
                    </ul>
                    <button class="btn btn-success w-100">
                        Создать профиль исполнителя
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section id="how-it-works" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title mb-2">Как работает платформа</h2>
            <p class="text-muted small mb-0">
                Простая последовательность шагов для безопасной сделки между заказчиком и исполнителем.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="h-100 p-4 bg-white rounded-4 border">
                    <div class="step-number bg-primary text-white mb-3">1</div>
                    <h6>Формирование задачи и подбор исполнителя</h6>
                    <p class="text-muted small mb-0">
                        Заказчик описывает задачу, бюджет и сроки. Система предлагает подходящих исполнителей
                        или открывает публичный тендер.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="h-100 p-4 bg-white rounded-4 border">
                    <div class="step-number bg-primary text-white mb-3">2</div>
                    <h6>Эскроу и выполнение работ</h6>
                    <p class="text-muted small mb-0">
                        Бюджет сделки резервируется на эскроу-счёте. Исполнитель выполняет работу по этапам
                        с фиксированными контрольными точками.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="h-100 p-4 bg-white rounded-4 border">
                    <div class="step-number bg-primary text-white mb-3">3</div>
                    <h6>Приёмка, оплата и рейтинг</h6>
                    <p class="text-muted small mb-0">
                        После подтверждения результата заказчиком, средства автоматически
                        переводятся исполнителю. Обе стороны оставляют честный отзыв.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECURITY BLOCK -->
<section id="security" class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title mb-3">Фокус на безопасности и прозрачности</h2>
                <p class="text-muted small mb-3">
                    Платформа LP3 Escrow разработана для того, чтобы минимизировать риски для обеих сторон.
                    Все ключевые действия в рамках сделки фиксируются и доступны в истории проекта.
                </p>
                <ul class="list-unstyled small mb-4">
                    <li class="mb-2">
                        <i class="bi bi-shield-lock-fill text-primary me-2"></i>
                        Эскроу-счёт: средства хранятся отдельно и не доступны до закрытия сделки
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-file-earmark-text-fill text-primary me-2"></i>
                        Юридически значимые оферты и шаблоны договоров
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-lightning-charge-fill text-primary me-2"></i>
                        Система арбитража для разрешения спорных ситуаций
                    </li>
                </ul>
                <button class="btn btn-outline-dark">
                    Подробнее о юридической модели
                </button>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="p-4 rounded-4 border bg-light">
                    <h6 class="mb-3">Краткая сводка по рискам</h6>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Риск невыплаты исполнителю</span>
                        <span class="fw-semibold text-success">Минимальный</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 10%;"></div>
                    </div>

                    <div class="d-flex justify-content-between small mb-2">
                        <span>Риск недобросовестного исполнителя</span>
                        <span class="fw-semibold text-warning">Контролируемый</span>
                    </div>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 40%;"></div>
                    </div>

                    <div class="d-flex justify-content-between small mb-2">
                        <span>Прозрачность сделки для обеих сторон</span>
                        <span class="fw-semibold text-primary">Высокая</span>
                    </div>
                    <div class="progress mb-4" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 90%;"></div>
                    </div>

                    <p class="text-muted small mb-0">
                        Все операции с бюджетом сделки логируются. В любой момент вы можете
                        скачать детальный отчёт по конкретному проекту или по всему аккаунту.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CASES / TESTIMONIALS -->
<section id="cases" class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title mb-0">Кейсы клиентов</h2>
            <a href="#" class="small text-decoration-none">Смотреть все кейсы</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <h6 class="mb-1">Разработка маркетплейса</h6>
                    <small class="text-muted d-block mb-3">B2B SaaS, Москва</small>
                    <p class="small text-muted">
                        Команда нашла исполнителя на полный цикл разработки: от прототипа до запуска
                        и сопровождения. Сделка была разбита на 5 этапов, оплата — через эскроу.
                    </p>
                    <div class="d-flex align-items-center justify-content-between small mt-3">
                        <span class="text-muted">Бюджет: около 2.5 млн ₽</span>
                        <span class="text-warning">
                            <i class="bi bi-star-fill"></i> 5.0
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <h6 class="mb-1">Редизайн корпоративного сайта</h6>
                    <small class="text-muted d-block mb-3">Дизайн-агентство, Алматы</small>
                    <p class="small text-muted">
                        Заказчик получил полный контроль над процессом: согласование дизайн-системы,
                        UI-kit и адаптивной вёрстки. Исполнитель — агентство с рейтингом 4.9.
                    </p>
                    <div class="d-flex align-items-center justify-content-between small mt-3">
                        <span class="text-muted">Срок: 6 недель</span>
                        <span class="text-warning">
                            <i class="bi bi-star-fill"></i> 4.9
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="testimonial-card p-4 h-100">
                    <h6 class="mb-1">Поддержка и доработка CRM</h6>
                    <small class="text-muted d-block mb-3">Фриланс-разработчик, Бишкек</small>
                    <p class="small text-muted">
                        Многомесячный контракт на поддержку CRM. Платформа позволила закрепить
                        SLA и автоматизировать ежемесячные выплаты исполнителю.
                    </p>
                    <div class="d-flex align-items-center justify-content-between small mt-3">
                        <span class="text-muted">Формат: долгосрочно</span>
                        <span class="text-warning">
                            <i class="bi bi-star-fill"></i> 4.8
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h2 class="section-title mb-2 text-white">
                    Готовы начать безопасную сделку?
                </h2>
                <p class="mb-0 small text-white-50">
                    Создайте первый проект как заказчик или оформите профиль исполнителя.
                    Регистрация занимает не более 2 минут.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-light me-2 mb-2">
                    Регистрация заказчика
                </button>
                <button class="btn btn-outline-light mb-2">
                    Регистрация исполнителя
                </button>
            </div>
        </div>
    </div>
</section>

<footer class="py-4 text-white-50">
    <div class="container">
        <div class="row gy-3 align-items-center">
            <div class="col-md-4 small">
                © 2026 LP3 Escrow. Все права защищены.
            </div>
            <div class="col-md-4 small text-md-center">
                <a href="#" class="text-white-50 text-decoration-none me-3">Пользовательское соглашение</a>
                <a href="#" class="text-white-50 text-decoration-none">Политика конфиденциальности</a>
            </div>
            <div class="col-md-4 small text-md-end">
                support@lp3-escrow.com
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<!-- Bootstrap Icons (по желанию) -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
/>
</body>
</html>