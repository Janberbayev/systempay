<nav class="navbar navbar-expand-lg navbar-creative sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/" style="text-decoration: none;">
            <div class="logo-icon">
                <i class="bi bi-shield-check-fill"></i>
            </div>
            <span class="logo-text">SystemPay</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--border-color);">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item"><a class="nav-link fw-semibold" href="/#features">Возможности</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/#how">Как работает</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/#roles">Роли</a></li>
                @auth
                    @can('view projects')
                        <li class="nav-item"><a class="nav-link fw-semibold" href="{{route('list-project')}}">Проекты</a></li>
                    @endcan
                    @can('view ads')
                        <li class="nav-item"><a class="nav-link fw-semibold" href="{{route('list-ads')}}">Объявления</a></li>
                    @endcan
                @endauth
                <li class="nav-item">
                    <button class="btn btn-sm nav-link fw-semibold" id="themeToggle" style="border: none; background: transparent; padding: 8px 16px !important; border-radius: 8px; cursor: pointer;">
                        <i class="bi bi-moon-stars" id="themeIcon"></i>
                    </button>
                </li>
                <li class="nav-item">
                    @if (Route::has('login'))
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-creative-secondary rounded px-4 dropdown-toggle"
                                        type="button"
                                        id="userDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
{{--                                    {{ Auth::user()->name }}--}}
                                    Кабинет
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    @if(Auth::user()->name == 'Admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.page') }}">Админка</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">Личный кабинет</a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">Личный кабинет</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Настройка</a>
                                    </li>
                                    <li><hr class="dropdown-divider" style="border-color: var(--border-color);"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Выйти</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-creative-accent rounded px-4">Войти</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-creative-accent rounded px-4 ms-2">Регистрация</a>
                            @endif
                        @endauth
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
