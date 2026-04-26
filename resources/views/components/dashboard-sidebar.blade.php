<div class="col-lg-3 col-md-4 mb-4">
    <div class="card-creative p-3" style="position: sticky; top: 100px;">
        <h5 class="fw-bold mb-4" style="color: var(--text-primary);">
            <i class="bi bi-person-circle me-2" style="color: var(--accent-green);"></i>
            Личный кабинет
        </h5>
        <nav class="dashboard-nav">
            <a href="{{ route('dashboard') }}" class="dashboard-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i>
                <span>Объявления и проекты</span>
            </a>
            <a href="{{ route('my-deal') }}" class="dashboard-nav-item {{ request()->routeIs('my-deal', 'show-deal') ? 'active' : '' }}">
                <i class="bi bi-file-text me-2"></i>
                <span>Мои сделки</span>
            </a>
            <a href="{{ route('messages') }}" class="dashboard-nav-item {{ request()->routeIs('messages') ? 'active' : '' }}">
                <i class="bi bi-envelope me-2"></i>
                <span>Сообщения</span>
            </a>
        </nav>
    </div>
</div>

<style>
    /* Dashboard Navigation Styles */
    .dashboard-nav {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dashboard-nav-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 10px;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 500;
        border: 1px solid transparent;
    }

    .dashboard-nav-item i {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
    }

    .dashboard-nav-item:hover {
        background: var(--bg-card-hover);
        color: var(--text-primary);
        border-color: var(--border-color);
    }

    .dashboard-nav-item.active {
        background: rgba(16, 163, 127, 0.15);
        color: var(--accent-green);
        border-color: rgba(16, 163, 127, 0.3);
    }

    .dashboard-nav-item.active i {
        color: var(--accent-green);
    }

    /* Responsive */
    @media (max-width: 767px) {
        .col-lg-3 {
            margin-bottom: 20px;
        }

        .card-creative {
            position: static !important;
        }
    }
</style>
