<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-12">
                    <a class="text-gray-800 font-bold text-xl" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="md:hidden text-gray-800 p-2" type="button" onclick="toggleNav()" aria-label="Toggle navigation">
                        <span class="block w-6 h-1 bg-gray-800 mb-1"></span>
                        <span class="block w-6 h-1 bg-gray-800 mb-1"></span>
                        <span class="block w-6 h-1 bg-gray-800"></span>
                    </button>

                    <div id="navbarSupportedContent" class="hidden md:flex md:items-center md:justify-end w-full md:w-auto">
                        <!-- Left Side Of Navbar -->
                        <ul class="flex space-x-4 md:mr-4">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="flex space-x-4">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-gray-700 hover:text-gray-900" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="text-gray-700 hover:text-gray-900" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="relative">
                                    <a id="navbarDropdown" class="text-gray-700 hover:text-gray-900 cursor-pointer" onclick="toggleDropdown()" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-10">
                                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
    function toggleNav() {
      const nav = document.getElementById('navbarSupportedContent');
      nav.classList.toggle('hidden');
    }
    function toggleDropdown() {
      const dropdown = document.getElementById('dropdown');
      dropdown.classList.toggle('hidden');
    }
    </script>
</body>
</html>
