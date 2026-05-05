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
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-base-bg text-base-text font-sans antialiased overflow-x-hidden">

    <!-- Sidebar -->
    <aside class="sidebar fixed left-0 top-0 bottom-0 w-sidebar bg-base-surface border-r border-base-border flex flex-col z-50 transition-transform duration-300 md:translate-x-0 -translate-x-full">
        <div class="p-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            </div>
            <span class="font-bold text-lg tracking-tight">HRPulse</span>
        </div>

        <nav class="px-4 mt-5 flex-grow">
            <div class="mb-1">
                <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[0.95rem] transition-all duration-200 {{ request()->routeIs('dashboard.admin') ? 'bg-indigo-50 text-primary' : 'text-base-muted hover:bg-slate-100 hover:text-primary' }}">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Dashboard
                </a>
            </div>
            <div class="mb-1">
                <a href="{{ route('admin.pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[0.95rem] transition-all duration-200 {{ request()->routeIs('admin.pegawai.*') ? 'bg-indigo-50 text-primary' : 'text-base-muted hover:bg-slate-100 hover:text-primary' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Pegawai
                </a>
            </div>
        </nav>

        <div class="p-5 border-t border-base-border">
            <div class="flex items-center gap-3 p-2 rounded-xl cursor-pointer transition-all duration-200 hover:bg-slate-100">
                <img src="https://ui-avatars.com/api/?name=Admin+Ivan&background=6366f1&color=fff" alt="Avatar" class="w-10 h-10 rounded-full bg-slate-200 object-cover">
                <div class="flex flex-col">
                    <span class="text-[0.9rem] font-semibold">Admin Ivan</span>
                    <span class="text-[0.75rem] text-base-muted">Super Admin</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-sidebar min-h-screen pb-10">
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
