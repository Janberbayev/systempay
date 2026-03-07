<!-- Admin Navigation Tabs -->
<div class="row mb-4">
    <div class="col-12">
        <ul class="nav nav-tabs" id="adminTabs" role="tablist" style="border-bottom: 1px solid var(--border-color);">
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('admin.page') ? 'active' : '' }}" href="{{ route('admin.page') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    <i class="bi bi-grid me-2"></i>Общие данные
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    <i class="bi bi-people me-2"></i>Роли
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--secondary);">
                    <i class="bi bi-person-check me-2"></i>Пользователи
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('admin-regions') ? 'active' : '' }}" href="{{ route('admin-regions') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    Области
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('admin-cities') ? 'active' : '' }}" href="{{ route('admin-cities') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    Города
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('admin.adverts') ? 'active' : '' }}" href="{{ route('admin.adverts') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    <i class="bi bi-megaphone me-2"></i>Объявления
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold {{ request()->routeIs('admin.projects') ? 'active' : '' }}" href="{{ route('admin.projects') }}" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    <i class="bi bi-briefcase me-2"></i>Проекты
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link fw-bold" href="#" style="border: 1px solid transparent; border-bottom: none; border-radius: 12px 12px 0 0; color: var(--primary);">
                    <i class="bi bi-handshake me-2"></i>Сделки
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        background: transparent;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 1px solid transparent;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
    }
    .nav-tabs .nav-link:hover {
        background: var(--bg-card-hover);
        border-color: transparent;
        color: var(--primary) !important;
    }
    .nav-tabs .nav-link.active {
        background: var(--bg-card);
        border-color: var(--border-color) var(--border-color) var(--bg-card);
        border-width: 1px;
        color: var(--primary) !important;
        border-bottom: 2px solid var(--primary);
    }
    .nav-tabs .nav-link.active[href*="users"] {
        color: var(--secondary) !important;
        border-bottom-color: var(--secondary);
    }
</style>
