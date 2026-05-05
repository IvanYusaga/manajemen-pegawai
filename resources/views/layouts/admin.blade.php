<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Manajemen Pegawai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --sidebar-width: 260px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-box {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .brand-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .nav-list {
            list-style: none;
            padding: 0 16px;
            margin-top: 20px;
            flex-grow: 1;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .nav-link.active {
            background: #eef2ff;
            color: var(--primary);
        }

        .nav-link i {
            width: 20px;
            height: 20px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-card:hover {
            background: #f1f5f9;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding-bottom: 40px;
        }


        /* Page Layout */
        .page-container {
            padding: 32px;
        }

        .welcome-section {
            margin-bottom: 32px;
        }

        .welcome-section h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-section p {
            color: var(--text-muted);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-info h3 {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-info .value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .bg-blue { background: #eef2ff; color: #6366f1; }
        .bg-green { background: #f0fdf4; color: #22c55e; }
        .bg-purple { background: #faf5ff; color: #a855f7; }
        .bg-orange { background: #fff7ed; color: #f97316; }

        /* Content Sections */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-size: 1.1rem;
            font-weight: 600;
        }


        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block !important;
            }
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-main);
        }

        .chart-container {
            padding: 24px;
            height: 300px;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-box">
                <i data-lucide="layout-dashboard"></i>
            </div>
            <span class="brand-name">HRPulse</span>
        </div>

        <nav class="nav-list">
            <div class="nav-item">
                <a href="{{ route('dashboard.admin') }}" class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                    <i data-lucide="home"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.pegawai.index') }}" class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                    <i data-lucide="users"></i>
                    Pegawai
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <img src="https://ui-avatars.com/api/?name=Admin+Ivan&background=6366f1&color=fff" alt="Avatar" class="user-avatar">
                <div class="user-info">
                    <span class="user-name">Admin Ivan</span>
                    <span class="user-role">Super Admin</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Optional: Header could go here -->
        @yield('content')
    </main>

    <script>
        lucide.createIcons();

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
