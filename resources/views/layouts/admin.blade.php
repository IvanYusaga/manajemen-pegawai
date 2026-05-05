<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Manajemen Pegawai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('style/assets/img/icon-logo.png') }}">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-base-bg text-base-text font-sans antialiased overflow-x-hidden">

    <!-- Sidebar -->
    <aside class="sidebar fixed left-0 top-0 bottom-0 w-sidebar bg-base-surface border-r border-base-border flex flex-col z-50 transition-transform duration-300 md:translate-x-0 -translate-x-full">
        <div class="p-6 flex items-center gap-3">
            <img src="{{ asset('style/assets/img/icon-logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            <span class="font-bold text-lg tracking-tight">HRPulse</span>
        </div>

        <nav class="px-4 mt-5 flex-grow">
            <div class="mb-1">
                <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[0.95rem] transition-all duration-200 {{ request()->routeIs('dashboard.admin') ? 'bg-indigo-50 text-primary' : 'text-base-muted hover:bg-slate-100 hover:text-primary' }}">
                    <img src="{{ asset('style/assets/img/dashboard-icon.png') }}" alt="Dashboard" class="w-5 h-5 object-contain">
                    Dashboard
                </a>
            </div>
            <div class="mb-1">
                <a href="{{ route('admin.pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[0.95rem] transition-all duration-200 {{ request()->routeIs('admin.pegawai.*') ? 'bg-indigo-50 text-primary' : 'text-base-muted hover:bg-slate-100 hover:text-primary' }}">
                    <img src="{{ asset('style/assets/img/pegawai-icon.png') }}" alt="Dashboard" class="w-5 h-5 object-contain">
                    Pegawai
                </a>
            </div>
        </nav>

    </aside>

    <!-- Main Content -->
    <main class="md:ml-sidebar min-h-screen pb-10">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight">@yield('title')</h1>
                @yield('subtitle')
            </div>

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
