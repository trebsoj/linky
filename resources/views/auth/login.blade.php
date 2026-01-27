<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>linky - Sign In</title>
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        // Dark mode detection - runs before page renders
        const savedTheme = localStorage.getItem('theme');
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        if (savedTheme === 'dark' || (!savedTheme && prefersDarkScheme.matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen p-4">
<!--<body class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:bg-gray-950 flex items-center justify-center min-h-screen p-4">-->

<div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
        <img src="/images/logo-nobk.png" alt="Linky" class="w-32 h-auto mx-auto mb-4 dark:brightness-90" style="max-width: 150px;">
        <h1 class="text-3xl font-bold">Welcome to Linky</h1>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Manage your links with elegance</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 border border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('Email Address') }}</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400 dark:text-gray-500">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                        placeholder="you@example.com"
                    >
                </div>
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('Password') }}</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400 dark:text-gray-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                        placeholder="••••••••"
                    >
                </div>
                @error('password')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox"
                    id="remember"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500"
                >
                <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Sign In') }}
            </button>


        </form>

    </div>

    <!-- Footer -->
    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-8">
        {{ config('app.name', 'Linky') }} &copy; 2026
    </p>
</div>

</body>
</html>


