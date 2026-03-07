<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SystemPay — Профессиональная платформа эскроу для безопасных сделок</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            /* ChatGPT dark theme (default) */
            --bg-dark: #0f0f23;
            --bg-darker: #0a0a1a;
            --bg-card: #1a1a2e;
            --bg-card-hover: #252540;
            --text-primary: #ececf1;
            --text-secondary: #8e8ea0;
            --text-muted: #6e6e80;
            --border-color: #2d2d44;
            --accent-green: #10a37f;
            --accent-green-hover: #0d8c6f;
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --shadow: rgba(0, 0, 0, 0.3);
        }
        
        .light-theme {
            /* ChatGPT light theme */
            --bg-dark: #ffffff;
            --bg-darker: #f7f7f8;
            --bg-card: #ffffff;
            --bg-card-hover: #f7f7f8;
            --text-primary: #202123;
            --text-secondary: #565869;
            --text-muted: #8e8ea0;
            --border-color: #e5e5e6;
            --shadow: rgba(0, 0, 0, 0.08);
        }
        
        .light-theme .hero-creative {
            background: linear-gradient(180deg, #ffffff 0%, #f7f7f8 100%);
        }
        
        .light-theme .hero-creative::before {
            background: radial-gradient(circle, rgba(16, 163, 127, 0.05) 0%, transparent 70%);
        }
        
        .light-theme .hero-creative::after {
            background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
        }
        
        .light-theme .hero-title-creative {
            background: none;
            -webkit-background-clip: unset;
            -webkit-text-fill-color: var(--text-primary);
            background-clip: unset;
        }
        
        .light-theme .navbar-creative {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .light-theme .nav-link:hover,
        .light-theme .nav-link.active {
            background: rgba(16, 163, 127, 0.08);
        }
        
        .light-theme .navbar-toggler-icon {
            filter: none !important;
        }
        
        .light-theme .card-creative {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        
        .light-theme .card-creative:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }
        
        .light-theme .btn-creative-accent:hover {
            background: rgba(16, 163, 127, 0.08);
        }
        
        .light-theme .role-card-creative:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }
        
        .light-theme .badge-creative {
            background: rgba(16, 163, 127, 0.1);
            border-color: rgba(16, 163, 127, 0.2);
        }
        
        .light-theme .dropdown-menu {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }
        
        .light-theme .form-control:focus {
            background: var(--bg-card);
        }
        
        .light-theme .btn-outline-primary {
            background: var(--bg-card);
        }
        
        .light-theme .alert-success {
            background: rgba(16, 163, 127, 0.1);
            border-color: rgba(16, 163, 127, 0.2);
        }
        
        .light-theme .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border-color: rgba(245, 158, 11, 0.2);
            color: #d97706;
        }
        
        * {
            letter-spacing: -0.01em;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        /* Navbar */
        .navbar-creative {
            background: rgba(15, 15, 35, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 8px var(--shadow);
        }
        
        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 8px 16px !important;
            border-radius: 8px;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--text-primary) !important;
            background: rgba(255, 255, 255, 0.05);
        }
        
        /* Hero Section */
        .hero-creative {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(180deg, var(--bg-dark) 0%, var(--bg-darker) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-creative::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(16, 163, 127, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -300px;
            right: -300px;
            animation: pulse 8s ease-in-out infinite;
        }
        
        .hero-creative::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -250px;
            left: -250px;
            animation: pulse 10s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .hero-title-creative {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
        }
        
        /* Cards */
        .card-creative {
            background: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 16px var(--shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-creative:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            border-color: var(--accent-green);
            background: var(--bg-card-hover);
        }
        
        /* Buttons */
        .btn-creative {
            background: var(--accent-green);
            color: white;
            font-weight: 600;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(16, 163, 127, 0.3);
            transition: all 0.2s ease;
        }
        
        .btn-creative:hover {
            background: var(--accent-green-hover);
            box-shadow: 0 6px 20px rgba(16, 163, 127, 0.4);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-creative-secondary {
            background: var(--accent-blue);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transition: all 0.2s ease;
        }
        
        .btn-creative-secondary:hover {
            background: #2563eb;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-creative-accent {
            background: transparent;
            color: var(--text-primary);
            border: 2px solid var(--border-color);
            box-shadow: none;
            transition: all 0.2s ease;
        }
        
        .btn-creative-accent:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent-green);
            color: var(--accent-green);
            transform: translateY(-2px);
        }
        
        /* Icons */
        .icon-creative {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--accent-green);
            transition: all 0.3s ease;
        }
        
        .icon-creative:hover {
            background: var(--bg-card-hover);
            border-color: var(--accent-green);
            transform: scale(1.05);
        }
        
        .icon-creative.primary {
            color: var(--accent-green);
            border-color: rgba(16, 163, 127, 0.3);
        }
        
        .icon-creative.secondary {
            color: var(--accent-blue);
            border-color: rgba(59, 130, 246, 0.3);
        }
        
        .icon-creative.accent {
            color: var(--accent-purple);
            border-color: rgba(139, 92, 246, 0.3);
        }
        
        /* Sections */
        .section-creative {
            padding: 100px 0;
            background: var(--bg-dark);
        }
        
        .section-creative[style*="background: white"] {
            background: var(--bg-darker) !important;
        }
        
        .section-creative[style*="background: #fffdf7"] {
            background: var(--bg-darker) !important;
        }
        
        /* Stats */
        .stat-number-creative {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--accent-green);
            line-height: 1;
        }
        
        /* Role Cards */
        .role-card-creative {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .role-card-creative:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px var(--shadow);
            border-color: var(--accent-green);
            background: var(--bg-card-hover);
        }
        
        /* Badge */
        .badge-creative {
            background: rgba(16, 163, 127, 0.15);
            color: var(--accent-green);
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid rgba(16, 163, 127, 0.3);
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        /* Logo */
        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--accent-blue) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(16, 163, 127, 0.3);
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .logo-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }
        
        .logo-icon:hover::before {
            left: 100%;
        }
        
        .logo-icon:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(16, 163, 127, 0.4);
        }
        
        .logo-icon i {
            font-size: 1.8rem;
            color: white;
            z-index: 1;
            position: relative;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .logo-text {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }
        
        /* Text Colors */
        .text-muted {
            color: var(--text-secondary) !important;
        }
        
        .text-white {
            color: var(--text-primary) !important;
        }
        
        .lead {
            color: var(--text-secondary);
        }
        
        /* Form Controls */
        .form-control {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 12px;
        }
        
        .form-control:focus {
            background: var(--bg-card-hover);
            border-color: var(--accent-green);
            color: var(--text-primary);
            box-shadow: 0 0 0 3px rgba(16, 163, 127, 0.1);
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        .form-label {
            color: var(--text-primary);
        }
        
        /* Outline Buttons */
        .btn-outline-primary {
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .btn-outline-primary:hover,
        .btn-check:checked + .btn-outline-primary {
            background: var(--accent-green);
            border-color: var(--accent-green);
            color: white;
        }
        
        /* Headings */
        h1, h2, h3, h4, h5, h6 {
            color: var(--text-primary);
        }
        
        .display-3, .display-4, .display-5 {
            color: var(--text-primary);
        }
        
        /* Dropdown */
        .dropdown-menu {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 32px var(--shadow);
        }
        
        .dropdown-item {
            color: var(--text-primary);
        }
        
        .dropdown-item:hover {
            background: var(--bg-card-hover);
            color: var(--accent-green);
        }
        
        /* Tables */
        .table {
            color: var(--text-primary);
        }
        
        .table thead th {
            border-bottom-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .table tbody tr {
            border-color: var(--border-color);
        }
        
        .table tbody tr:hover {
            background: var(--bg-card-hover);
        }
        
        /* Alerts */
        .alert {
            border-color: var(--border-color);
        }
        
        .alert-success {
            background: rgba(16, 163, 127, 0.15);
            border-color: rgba(16, 163, 127, 0.3);
            color: var(--accent-green);
        }
        
        .alert-warning {
            background: rgba(245, 158, 11, 0.15);
            border-color: rgba(245, 158, 11, 0.3);
            color: #fbbf24;
        }
        
        /* Input Group */
        .input-group-text {
            background: var(--bg-card);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }
        
        /* Theme Toggle Button */
        #themeToggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            transition: all 0.2s ease;
        }
        
        #themeToggle:hover {
            background: rgba(255, 255, 255, 0.05) !important;
        }
        
        .light-theme #themeToggle:hover {
            background: rgba(16, 163, 127, 0.08) !important;
        }
        
        #themeIcon {
            font-size: 1.2rem;
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }
        
        #themeToggle:hover #themeIcon {
            color: var(--accent-green);
            transform: rotate(15deg);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .hero-title-creative {
                font-size: 2.5rem;
            }
            .logo-icon {
                width: 40px;
                height: 40px;
            }
            .logo-text {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
