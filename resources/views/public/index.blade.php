@extends('layout')

@section('content')

    <!-- Search Bar -->
    <div class="mb-6 flex flex-col sm:flex-row gap-3">
        <form method="GET" action="{{ route('public.index') }}" class="flex flex-1 gap-2">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-3 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search links..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                    autocomplete="off"
                >
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-search"></i>
                <span class="hidden sm:inline">Search</span>
            </button>
        </form>
        @if($search ?? '')
        <a href="{{ route('public.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
            <i class="fas fa-times"></i>
            <span class="hidden sm:inline">Clear</span>
        </a>
        @endif
    </div>

    <!-- Links List -->
    <div class="space-y-12">
        @php
            $previousGroup = ''
        @endphp

        @foreach ($links as $item)
            @if($previousGroup != $item->group->name)
                @if($previousGroup != '')
                    </div> <!-- Close previous group grid -->
                </div> <!-- Close previous group container -->
                @endif
                <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2 mb-4">
                        <img src="/images/favicon.png" height="20" alt="Group icon" class="w-5 h-5">
                        {{$item->group->name}}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @endif

            @if(str_contains($item->href, 'http'))
                <a href="{{$item->href}}" target="_blank" rel="noopener noreferrer" class="group flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-800 dark:border-gray-700 rounded-lg hover:shadow-md hover:border-blue-400 dark:hover:border-blue-500 transition h-full">
                    <div class="flex-1 min-w-0">
                        <span class="font-medium text-gray-900 dark:text-gray-100 truncate block">{{$item->name}}</span>
                    </div>
                </a>
            @else
                <a href="\\{{$item->href}}" target="_blank" rel="noopener noreferrer" class="group flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-800 dark:border-gray-700 rounded-lg hover:shadow-md hover:border-blue-400 dark:hover:border-blue-500 transition h-full">
                    <div class="flex-1 min-w-0">
                        <span class="font-medium text-gray-900 dark:text-gray-100 truncate block">{{$item->name}}</span>
                    </div>
                </a>
            @endif

            @php
                $previousGroup = $item->group->name
            @endphp
        @endforeach

        @if($previousGroup != '')
                </div> <!-- Close last group grid -->
            </div> <!-- Close last group container -->
        @endif

        @if(count($links) == 0)
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 dark:text-gray-600 text-5xl mb-4 block"></i>
                <p class="text-gray-500 dark:text-gray-400 text-lg">No links available</p>
                <p class="text-gray-400 dark:text-gray-500 text-sm">Check back later for new content</p>
            </div>
        @endif
    </div>
    </div>

@endsection
