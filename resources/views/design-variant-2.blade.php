<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>LP3 Escrow — Минималистичный дизайн</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --dark: #0f172a;
            --light: #f8fafc;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--dark);
            background: #ffffff;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .hero-minimal {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero-minimal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>');
            opacity: 0.3;
        }
        .hero-title-minimal {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }
        .role-card-minimal {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }
        .role-card-minimal:hover {
            border-color: var(--primary);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 12px;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
            color: white;
        }
        .section-spacing {
            padding: 100px 0;
        }
        .stat-card {
            text-align: center;
            padding: 2rem;
            border-radius: 16px;
            background: linear-gradient(135deg, #f6f8fb 0%, #ffffff 100%);
        }
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="color: var(--primary);">
            LP3 Escrow
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item"><a class="nav-link" href="#features">Возможности</a></li>
                <li class="nav-item"><a class="nav-link" href="#how">Как работает</a></li>
                <li class="nav-item"><a class="nav-link" href="#roles">Роли</a></li>
                <li class="nav-item">
                    <button class="btn btn-outline-primary rounded-pill px-4">Войти</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-gradient rounded-pill px-4">Начать</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-minimal">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mb-4">
                    <span class="badge bg-white bg-opacity-20 text-white px-3 py-2 rounded-pill">
                        Безопасные сделки через эскроу
                    </span>
                </div>
                <h1 class="hero-title-minimal mb-4">
                    Профессиональная платформа для заказчиков и исполнителей
                </h1>
                <p class="lead mb-5" style="opacity: 0.95;">
                    Создавайте проекты, находите проверенных специалистов и проводите безопасные сделки
                    с гарантией оплаты через эскроу-счёт.
                </p>
                <div class="d-flex flex-wrap gap-3 mb-5">
                    <button class="btn btn-light btn-lg rounded-pill px-5">
                        <i class="bi bi-briefcase me-2"></i>Я заказчик
                    </button>
                    <button class="btn btn-outline-light btn-lg rounded-pill px-5">
                        <i class="bi bi-person-check me-2"></i>Я исполнитель
                    </button>
                </div>
                <div class="row g-4">
                    <div class="col-4">
                        <div class="stat-number">12K+</div>
                        <small class="text-white-50">Сделок</small>
                    </div>
                    <div class="col-4">
                        <div class="stat-number">4.9</div>
                        <small class="text-white-50">Рейтинг</small>
                    </div>
                    <div class="col-4">
                        <div class="stat-number">98%</div>
                        <small class="text-white-50">Успех</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-glass p-5 rounded-4">
                    <h4 class="mb-4 fw-bold">Быстрый старт</h4>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Выберите роль</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="role" id="customer2" checked>
                            <label class="btn btn-outline-primary rounded-start-pill" for="customer2">Заказчик</label>
                            <input type="radio" class="btn-check" name="role" id="performer2">
                            <label class="btn btn-outline-primary rounded-end-pill" for="performer2">Исполнитель</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Опишите задачу</label>
                        <textarea class="form-control rounded-3" rows="4" 
                                  placeholder="Например: Нужен разработчик для создания веб-приложения"></textarea>
                    </div>
                    <button class="btn btn-gradient w-100 rounded-pill py-3">
                        Начать проект
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="section-spacing bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Почему выбирают нас</h2>
            <p class="lead text-muted">Всё необходимое для успешного сотрудничества</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-icon mb-3">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="fw-bold mb-3">Безопасность</h5>
                <p class="text-muted">
                    Эскроу-счёт защищает обе стороны. Средства резервируются и переводятся только после
                    успешного завершения работы.
                </p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h5 class="fw-bold mb-3">Прозрачность</h5>
                <p class="text-muted">
                    Полный контроль над проектом. Отслеживайте прогресс, общайтесь в чате и получайте
                    уведомления о каждом этапе.
                </p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon mb-3">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h5 class="fw-bold mb-3">Скорость</h5>
                <p class="text-muted">
                    Быстрый подбор исполнителей, моментальные уведомления и автоматизированные выплаты
                    без задержек.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ROLES -->
<section id="roles" class="section-spacing">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Две роли, одна платформа</h2>
            <p class="lead text-muted">Выберите свою роль и начните работу</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="role-card-minimal p-5 h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon me-3" style="width: 56px; height: 56px; font-size: 1.5rem;">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Заказчик</h4>
                            <small class="text-muted">Для бизнеса и стартапов</small>
                        </div>
                    </div>
                    <p class="text-muted mb-4">
                        Размещайте задачи, выбирайте исполнителей по рейтингу и портфолио,
                        контролируйте ход работ через этапы.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Безопасная предоплата через эскроу
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Детальная аналитика и отчёты
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Встроенный чат и файлообмен
                        </li>
                    </ul>
                    <button class="btn btn-gradient w-100 rounded-pill">
                        Создать проект
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="role-card-minimal p-5 h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div class="feature-icon me-3" style="width: 56px; height: 56px; font-size: 1.5rem; background: linear-gradient(135deg, #10b981, #059669);">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Исполнитель</h4>
                            <small class="text-muted">Для фрилансеров и команд</small>
                        </div>
                    </div>
                    <p class="text-muted mb-4">
                        Получайте доступ к качественным проектам, выстраивайте репутацию
                        и защищайте свои интересы.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гарантированная оплата после сдачи
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Гибкая настройка профиля
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Рейтинг и отзывы
                        </li>
                    </ul>
                    <button class="btn btn-gradient w-100 rounded-pill" style="background: linear-gradient(135deg, #10b981, #059669);">
                        Создать профиль
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section id="how" class="section-spacing bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3">Как это работает</h2>
            <p class="lead text-muted">Три простых шага к успешной сделке</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold mb-3">Создайте проект</h5>
                    <p class="text-muted">
                        Опишите задачу, укажите бюджет и сроки. Система автоматически подберёт
                        подходящих исполнителей.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold mb-3">Выберите исполнителя</h5>
                    <p class="text-muted">
                        Просмотрите предложения, портфолио и рейтинги. Средства автоматически
                        резервируются на эскроу-счёте.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2rem;">
                        <span class="fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold mb-3">Получите результат</h5>
                    <p class="text-muted">
                        После подтверждения работы средства автоматически переводятся исполнителю.
                        Обе стороны оставляют отзывы.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-spacing" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
    <div class="container text-center">
        <h2 class="display-4 fw-bold mb-4">Готовы начать?</h2>
        <p class="lead mb-5" style="opacity: 0.95;">
            Присоединяйтесь к тысячам заказчиков и исполнителей, которые уже используют LP3 Escrow
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <button class="btn btn-light btn-lg rounded-pill px-5">
                Регистрация заказчика
            </button>
            <button class="btn btn-outline-light btn-lg rounded-pill px-5">
                Регистрация исполнителя
            </button>
        </div>
    </div>
</section>

<footer class="py-5 bg-dark text-white-50">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="text-white mb-3">LP3 Escrow</h5>
                <p class="small">Профессиональная платформа для безопасных сделок между заказчиками и исполнителями.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Ссылки</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white-50 text-decoration-none">О нас</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Как это работает</a></li>
                    <li><a href="#" class="text-white-50 text-decoration-none">Безопасность</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white mb-3">Контакты</h6>
                <p class="small mb-0">support@lp3-escrow.com</p>
                <p class="small">© 2026 LP3 Escrow. Все права защищены.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
