<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LP3 Escrow — Темный корпоративный дизайн</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --dark-bg: #0a0e27;
            --dark-card: #141b3d;
            --dark-border: #1e2747;
            --accent: #00d4ff;
            --accent-dark: #0099cc;
            --text-light: #a0aec0;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark-bg);
            color: #ffffff;
        }
        .navbar-dark-custom {
            background: rgba(10, 14, 39, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--dark-border);
        }
        .hero-dark {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-dark::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-title-dark {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            background: linear-gradient(135deg, #ffffff 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-dark {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 16px;
            color: #ffffff;
        }
        .card-dark:hover {
            border-color: var(--accent);
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.2);
        }
        .btn-accent {
            background: var(--accent);
            color: var(--dark-bg);
            font-weight: 600;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
        }
        .btn-accent:hover {
            background: var(--accent-dark);
            color: var(--dark-bg);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 212, 255, 0.3);
        }
        .btn-outline-accent {
            border: 2px solid var(--accent);
            color: var(--accent);
            background: transparent;
        }
        .btn-outline-accent:hover {
            background: var(--accent);
            color: var(--dark-bg);
        }
        .icon-box {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.2), rgba(0, 212, 255, 0.1));
            border: 1px solid rgba(0, 212, 255, 0.3);
            color: var(--accent);
        }
        .section-dark {
            padding: 100px 0;
        }
        .stat-dark {
            text-align: center;
            padding: 2rem;
        }
        .stat-number-dark {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--accent);
        }
        .role-card-dark {
            background: var(--dark-card);
            border: 2px solid var(--dark-border);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        .role-card-dark:hover {
            border-color: var(--accent);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 212, 255, 0.15);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-dark-custom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="color: var(--accent);">
            LP3 Escrow
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item"><a class="nav-link" href="#features">Возможности</a></li>
                <li class="nav-item"><a class="nav-link" href="#how">Процесс</a></li>
                <li class="nav-item"><a class="nav-link" href="#roles">Роли</a></li>
                <li class="nav-item">
                    <button class="btn btn-outline-accent rounded-pill px-4">Войти</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-accent rounded-pill px-4">Начать</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-dark">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mb-4">
                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(0, 212, 255, 0.2); color: var(--accent); border: 1px solid rgba(0, 212, 255, 0.3);">
                        Эскроу-сервис нового поколения
                    </span>
                </div>
                <h1 class="hero-title-dark mb-4">
                    Корпоративная платформа для безопасных сделок
                </h1>
                <p class="lead mb-5" style="color: var(--text-light);">
                    Профессиональная среда для заказчиков и исполнителей с полной защитой интересов
                    обеих сторон через эскроу-счёт и прозрачные условия сотрудничества.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <button class="btn btn-accent btn-lg rounded-pill px-5">
                        <i class="bi bi-briefcase me-2"></i>Для заказчиков
                    </button>
                    <button class="btn btn-outline-accent btn-lg rounded-pill px-5">
                        <i class="bi bi-person-check me-2"></i>Для исполнителей
                    </button>
                </div>
                <div class="row g-4">
                    <div class="col-4">
                        <div class="stat-number-dark">12K+</div>
                        <small class="text-muted">Завершённых сделок</small>
                    </div>
                    <div class="col-4">
                        <div class="stat-number-dark">4.9</div>
                        <small class="text-muted">Средний рейтинг</small>
                    </div>
                    <div class="col-4">
                        <div class="stat-number-dark">98%</div>
                        <small class="text-muted">Успешных проектов</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-dark p-5">
                    <h4 class="mb-4 fw-bold">Быстрый старт</h4>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ваша роль</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="role3" id="customer3" checked>
                            <label class="btn btn-outline-accent rounded-start-pill" for="customer3">Заказчик</label>
                            <input type="radio" class="btn-check" name="role3" id="performer3">
                            <label class="btn btn-outline-accent rounded-end-pill" for="performer3">Исполнитель</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Описание проекта</label>
                        <textarea class="form-control bg-dark border-dark text-white rounded-3" rows="4" 
                                  placeholder="Опишите задачу или вашу специализацию" style="border-color: var(--dark-border);"></textarea>
                    </div>
                    <button class="btn btn-accent w-100 rounded-pill py-3">
                        Начать работу
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="section-dark">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Ключевые преимущества</h2>
            <p class="lead" style="color: var(--text-light);">Всё для безопасного и эффективного сотрудничества</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="icon-box mb-4">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h5 class="fw-bold mb-3">Максимальная безопасность</h5>
                <p style="color: var(--text-light);">
                    Эскроу-счёт защищает средства до завершения работы. Все транзакции прозрачны
                    и отслеживаемы в реальном времени.
                </p>
            </div>
            <div class="col-md-4">
                <div class="icon-box mb-4">
                    <i class="bi bi-eye"></i>
                </div>
                <h5 class="fw-bold mb-3">Полная прозрачность</h5>
                <p style="color: var(--text-light);">
                    Детальная история всех операций, этапов проекта и коммуникаций. Полный контроль
                    над бюджетом и сроками.
                </p>
            </div>
            <div class="col-md-4">
                <div class="icon-box mb-4">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h5 class="fw-bold mb-3">Аналитика и отчёты</h5>
                <p style="color: var(--text-light);">
                    Глубокая аналитика по проектам, исполнителям и бюджетам. Экспорт данных для
                    бухгалтерии и отчётности.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section id="roles" class="section-dark" style="background: var(--dark-card);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Две стороны одной платформы</h2>
            <p class="lead" style="color: var(--text-light);">Выберите свою роль и начните работу</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="role-card-dark h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3" style="width: 64px; height: 64px; font-size: 1.5rem;">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Заказчик</h4>
                            <small style="color: var(--text-light);">Бизнес и стартапы</small>
                        </div>
                    </div>
                    <p style="color: var(--text-light);" class="mb-4">
                        Размещайте проекты, выбирайте исполнителей по рейтингу и портфолио,
                        контролируйте каждый этап работы.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--accent);"></i>
                            <span style="color: var(--text-light);">Безопасная предоплата через эскроу</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--accent);"></i>
                            <span style="color: var(--text-light);">Детальная аналитика и отчёты</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--accent);"></i>
                            <span style="color: var(--text-light);">Встроенный чат и файлообмен</span>
                        </li>
                    </ul>
                    <button class="btn btn-accent w-100 rounded-pill">
                        Создать проект
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="role-card-dark h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box me-3" style="width: 64px; height: 64px; font-size: 1.5rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1)); border-color: rgba(16, 185, 129, 0.3); color: #10b981;">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Исполнитель</h4>
                            <small style="color: var(--text-light);">Фрилансеры и команды</small>
                        </div>
                    </div>
                    <p style="color: var(--text-light);" class="mb-4">
                        Получайте доступ к качественным проектам, выстраивайте репутацию
                        и защищайте свои интересы.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: #10b981;"></i>
                            <span style="color: var(--text-light);">Гарантированная оплата после сдачи</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: #10b981;"></i>
                            <span style="color: var(--text-light);">Гибкая настройка профиля</span>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill me-2" style="color: #10b981;"></i>
                            <span style="color: var(--text-light);">Рейтинг и отзывы</span>
                        </li>
                    </ul>
                    <button class="btn btn-accent w-100 rounded-pill" style="background: #10b981;">
                        Создать профиль
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section id="how" class="section-dark">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Процесс работы</h2>
            <p class="lead" style="color: var(--text-light);">Три шага к успешной сделке</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-dark p-4 h-100 text-center">
                    <div class="icon-box mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold mb-3">Создание проекта</h5>
                    <p style="color: var(--text-light);">
                        Опишите задачу, укажите бюджет и сроки. Система автоматически подберёт
                        подходящих исполнителей.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-dark p-4 h-100 text-center">
                    <div class="icon-box mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold mb-3">Выбор исполнителя</h5>
                    <p style="color: var(--text-light);">
                        Просмотрите предложения, портфолио и рейтинги. Средства автоматически
                        резервируются на эскроу-счёте.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-dark p-4 h-100 text-center">
                    <div class="icon-box mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold mb-3">Завершение сделки</h5>
                    <p style="color: var(--text-light);">
                        После подтверждения работы средства автоматически переводятся исполнителю.
                        Обе стороны оставляют отзывы.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-dark" style="background: linear-gradient(135deg, var(--dark-card), var(--dark-bg));">
    <div class="container text-center">
        <h2 class="display-4 fw-bold mb-4">Готовы начать работу?</h2>
        <p class="lead mb-5" style="color: var(--text-light);">
            Присоединяйтесь к тысячам профессионалов, которые уже используют LP3 Escrow
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <button class="btn btn-accent btn-lg rounded-pill px-5">
                Регистрация заказчика
            </button>
            <button class="btn btn-outline-accent btn-lg rounded-pill px-5">
                Регистрация исполнителя
            </button>
        </div>
    </div>
</section>

<footer class="py-5" style="background: var(--dark-card); border-top: 1px solid var(--dark-border);">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="mb-3" style="color: var(--accent);">LP3 Escrow</h5>
                <p class="small" style="color: var(--text-light);">
                    Корпоративная платформа для безопасных сделок между заказчиками и исполнителями.
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="mb-3">Ссылки</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none" style="color: var(--text-light);">О нас</a></li>
                    <li><a href="#" class="text-decoration-none" style="color: var(--text-light);">Как это работает</a></li>
                    <li><a href="#" class="text-decoration-none" style="color: var(--text-light);">Безопасность</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="mb-3">Контакты</h6>
                <p class="small mb-0" style="color: var(--text-light);">support@lp3-escrow.com</p>
                <p class="small" style="color: var(--text-light);">© 2026 LP3 Escrow. Все права защищены.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
