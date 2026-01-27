<!doctype html>
<html lang="en">
  <head>
    <title>Linky</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="/css/general.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.png">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar { scrollbar-width: thin; scrollbar-color: #cbd5e1 #f1f5f9; }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: #f1f5f9; }
        .sidebar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
    </style>
  </head>

  <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

  <!-- Header -->
  <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 shadow-sm z-40">
    <div class="flex items-center justify-between px-4 py-2 md:px-6">
      <div class="flex items-center gap-3">
        <button class="md:hidden p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition" onclick="toggleSidebar()" aria-label="Toggle navigation">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
        @if(empty($public))
          <a class="flex items-center gap-2 hover:opacity-80 transition" href="{{route('link.index')}}">
            <img src="/images/logo-nobk.png" height="24" style="max-width: 75px; height: auto;" alt="Logo">
          </a>
        @else
          <a class="flex items-center gap-2 hover:opacity-80 transition" href="{{route('public.index')}}">
            <img src="/images/logo-nobk.png" height="24" style="max-width: 75px; height: auto;" alt="Logo">
          </a>
        @endif
      </div>
    </div>
  </header>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    @if(empty($public))
    <nav id="sidebarMenu" class="fixed md:sticky top-12 md:top-0 left-0 w-64 h-[calc(100vh-3rem)] md:h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-30 md:z-0 sidebar">
      <div class="p-3 space-y-6">

        <!-- Navigation Links -->
        @if(empty($public))
          <div class="space-y-1">
            <a class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition external-link-btn" target="_blank" href="{{route('public.index')}}">
              <i class="fas fa-external-link-alt w-5 text-blue-400"></i>
              <span class="text-sm font-medium">Public page</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-gray-700 hover:text-amber-600 dark:hover:text-amber-400 rounded-lg transition {{ Request::is('variable') ? 'bg-amber-50 dark:bg-gray-700 text-amber-600 dark:text-amber-400' : '' }}" href="{{route('variable.index')}}">
              <i class="fas fa-dollar-sign w-5 text-amber-400"></i>
              <span class="text-sm font-medium">Variables</span>
            </a>
          </div>
        @endif

        <!-- Groups Section -->
        <div>
          <ul class="space-y-1 border-b border-t border-gray-200 dark:border-gray-700 pb-4">
            @foreach ($groups as $item)
              @if(!empty($public) && $item->links_public == 0)
                @continue
              @endif
              <li>
                <a class="flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition {{ Helper::isMenuActive($item, Request::segment(1), Request::segment(2),Request::segment(3)) ? 'bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-blue-400 font-medium' : '' }}"
                   href="@if(empty($public)){{route('group.show', $item)}}@else{{route('public.group.show', $item)}}@endif"
                >
                  <img src="/images/favicon.png" height="16" alt="{{$item->name}}" class="w-4 h-4">
                  <span class="text-sm truncate">{{$item->name}}</span>
                </a>
              </li>
            @endforeach
          </ul>

          <form action="{{route('group.store')}}" method="POST" class="space-y-3" novalidate>
              @csrf
              <input type="text" name="name" placeholder="Group name..."
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100"
                id="newGroupName" required>
              <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg font-medium transition text-sm flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i>
                Create Group
              </button>
            </form>
        </div>

        <!-- Dark Mode Toggle -->
        @if(empty($public))
          <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
            <button id="darkModeToggle" class="w-full flex items-center gap-3 px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
              <i class="fas fa-sun w-5 text-gray-400 dark:text-gray-300"></i>
              <span class="text-sm font-medium">Dark Mode</span>
               <span class="ml-auto relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200" role="switch" aria-checked="false">
                 <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-0"></span>
               </span>
            </button>
          </div>
        @endif

        <!-- Logout Form -->
        @if(empty($public))
          <form action="{{route('logout')}}" method="POST" class="border-t border-gray-200 dark:border-gray-700 pt-4" id="fmLogout" novalidate>
            @csrf
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition text-sm flex items-center justify-center gap-2">
              <i class="fas fa-sign-out-alt"></i>
              Logout
            </button>
          </form>
        @endif
      </div>
    </nav>
    @endif

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
      <div class="max-w-7xl mx-auto p-4 md:p-6">

        <!-- Error Messages -->
        @if ($errors->any())
          <div class="bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg mb-6" role="alert">
            <div class="flex items-start gap-3">
              <i class="fas fa-exclamation-circle mt-1"></i>
              <div>
                <p class="font-medium mb-1">Validation Errors:</p>
                <ul class="list-disc list-inside space-y-1 text-sm">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

        <!-- Success Messages -->
        @if(session('status'))
          <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg mb-6" role="alert">
            <div class="flex items-center gap-3">
              <i class="fas fa-check-circle"></i>
              <p class="font-medium">{{session('status')}}</p>
            </div>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.classList.toggle('-translate-x-full');
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById('sidebarMenu');
      const toggleBtn = event.target.closest('button[aria-label="Toggle navigation"]');
      if (!sidebar.contains(event.target) && !toggleBtn && window.innerWidth < 768) {
        sidebar.classList.add('-translate-x-full');
      }
    });

    // Dark mode toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

    function setDarkMode(isDark) {
        console.log('isDark: '+isDark)
        if (isDark) {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        updateToggleState(isDark);
    }

    function updateToggleState(isDark) {
        console.log('darkModeToggle '+darkModeToggle)
        if (darkModeToggle) {
            const icon = darkModeToggle.querySelector('i');
            const switchSpan = darkModeToggle.querySelector('span[role="switch"]');
            const circleSpan = switchSpan.querySelector('span[aria-hidden="true"]');

            if (isDark) {
                // Update icon to sun
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');

                // Update toggle switch
                switchSpan.classList.add('bg-blue-600');
                switchSpan.classList.remove('bg-gray-200');
                switchSpan.setAttribute('aria-checked', 'true');
                circleSpan.classList.add('translate-x-5');
                circleSpan.classList.remove('translate-x-0');
            } else {
                // Update icon to moon
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');

                // Update toggle switch
                switchSpan.classList.add('bg-gray-200');
                switchSpan.classList.remove('bg-blue-600');
                switchSpan.setAttribute('aria-checked', 'false');
                circleSpan.classList.add('translate-x-0');
                circleSpan.classList.remove('translate-x-5');
            }
        }
    }

    // Initialize dark mode based on localStorage or system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        setDarkMode(true);
    } else if (savedTheme === 'light') {
        setDarkMode(false);
    } else if (prefersDarkScheme.matches) {
        setDarkMode(true);
    } else {
        setDarkMode(false);
    }

    // Listen for changes in system preference
    prefersDarkScheme.addEventListener('change', (event) => {
        if (!localStorage.getItem('theme')) { // Only update if no explicit choice
            setDarkMode(event.matches);
        }
    });

    // Toggle dark mode on button click
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const isCurrentlyDark = html.classList.contains('dark');
            setDarkMode(!isCurrentlyDark);
        });
    }
  </script>
  </body>

</html>
