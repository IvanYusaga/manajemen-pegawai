<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-base-bg text-base-text min-h-screen flex flex-col items-center justify-center p-6 antialiased font-sans">
    
    <div class="w-full max-w-[420px]">
        <!-- Logo/Brand -->
        <div class="mb-10 text-center animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary text-white shadow-lg shadow-indigo-100 mb-5 transition-transform hover:rotate-3">
                <i data-lucide="layout-dashboard" class="w-7 h-7"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight">HRPulse</h1>
            <p class="text-base-muted mt-2 text-sm">Masuk untuk mengelola data pegawai Anda</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white border border-base-border shadow-xl shadow-slate-200/50 rounded-3xl p-8 md:p-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">
            
            <form method="POST" action="{{ route('store.login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold ml-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="flex h-12 w-full rounded-xl border border-base-border bg-white px-4 py-2 text-[0.95rem] placeholder:text-base-muted focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all"
                        placeholder="admin@hrpulse.id">
                    @error('email')
                        <p class="text-xs text-red-500 font-medium mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold ml-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="flex h-12 w-full rounded-xl border border-base-border bg-white px-4 py-2 text-[0.95rem] placeholder:text-base-muted focus:outline-none focus:ring-4 focus:ring-indigo-50 focus:border-primary transition-all"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-xs text-red-500 font-medium mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl text-[0.95rem] font-bold bg-primary text-white hover:bg-primary-hover h-12 px-4 py-2 w-full shadow-lg shadow-indigo-100 transition-all active:scale-[0.98] mt-2">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>
</html>
