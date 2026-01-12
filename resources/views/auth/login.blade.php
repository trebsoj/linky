<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>linky - Sign In</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-50 flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
        <img src="/images/logo-nobk.png" alt="Linky" class="w-32 h-auto mx-auto mb-4">
        <h1 class="text-3xl font-bold text-gray-900">Welcome to Linky</h1>
        <p class="text-gray-600 mt-2">Manage your links with elegance</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
        <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Email Address') }}</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        autofocus
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="you@example.com"
                    >
                </div>
                @error('email')
                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Password') }}</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="••••••••"
                    >
                </div>
                @error('password')
                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
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
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                >
                <label for="remember" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Sign In') }}
            </button>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </form>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">{{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    {{ __('Register here') }}
                </a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <p class="text-center text-gray-500 text-sm mt-8">
        {{ config('app.name', 'Linky') }} &copy; 2026
    </p>
</div>

</body>
</html>


