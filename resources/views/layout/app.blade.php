<!doctype html>
<html lang="ru">

{{--Head--}}
@include('layout.header')

<body>

{{--Navbar--}}
@include('layout.navbar')

{{--Main Content--}}
@yield('content')

{{--Footer--}}
@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Theme Toggle
    (function() {
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const body = document.body;
        
        // Проверяем сохраненную тему или системную
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const currentTheme = savedTheme || (prefersDark ? 'dark' : 'light');
        
        // Применяем тему
        if (currentTheme === 'light') {
            body.classList.add('light-theme');
            themeIcon.className = 'bi bi-sun';
        } else {
            body.classList.remove('light-theme');
            themeIcon.className = 'bi bi-moon-stars';
        }
        
        // Переключение темы
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                body.classList.toggle('light-theme');
                const isLight = body.classList.contains('light-theme');
                
                if (isLight) {
                    themeIcon.className = 'bi bi-sun';
                    localStorage.setItem('theme', 'light');
                } else {
                    themeIcon.className = 'bi bi-moon-stars';
                    localStorage.setItem('theme', 'dark');
                }
            });
        }
    })();

    // Navbar Active Link by Hash and Route (только ссылки в навбаре, не трогаем вкладки на других страницах)
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.navbar .nav-link');

        function setActiveLink() {
            links.forEach(link => link.classList.remove('active'));

            const hash = window.location.hash;
            const pathname = window.location.pathname;

            // Проверяем хэш для ссылок на главной странице
            if (hash) {
                const activeLink = document.querySelector(`a[href*="${hash}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                    return;
                }
            }

            // Проверяем путь для маршрутов (например, list-project)
            if (pathname.includes('list-project')) {
                const listProjectLink = document.querySelector('a[href*="list-project"]');
                if (listProjectLink) {
                    listProjectLink.classList.add('active');
                    return;
                }
            }

            // Если на главной странице без хэша, активируем первую ссылку
            if (pathname === '/') {
                const firstLink = document.querySelector('.navbar .nav-link[href*="#features"]');
                if (firstLink) {
                    firstLink.classList.add('active');
                }
            }
        }

        setActiveLink();
        window.addEventListener('hashchange', setActiveLink);
        
        // Также обновляем при изменении пути (для SPA или переходах между страницами)
        let lastPath = window.location.pathname;
        setInterval(function() {
            if (window.location.pathname !== lastPath) {
                lastPath = window.location.pathname;
                setActiveLink();
            }
        }, 100);
    });
</script>
@stack('scripts')
</body>
</html>
