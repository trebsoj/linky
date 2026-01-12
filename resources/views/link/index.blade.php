@extends('layout')

@section('content')

    <!-- Search Section -->
    <div class="mb-6 flex flex-col sm:flex-row gap-3">
        <form method="GET" action="{{ route('home') }}" class="flex flex-1 gap-2">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-3 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ $search ?? '' }}" 
                    placeholder="Search links..." 
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    autocomplete="off"
                >
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-search"></i>
                <span class="hidden sm:inline">Search</span>
            </button>
        </form>
        @if($search ?? '')
        <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
            <i class="fas fa-times"></i>
            <span class="hidden sm:inline">Clear</span>
        </a>
        @endif
    </div>

    <!-- Links List -->
    <div class="space-y-6">
        @php
            $previousGroup = ''
        @endphp

        @foreach ($links as $item)
            @if($previousGroup <> $item->group->name)
                <div class="mt-8 pt-4 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-4">
                        <img src="/images/favicon.png" height="20" alt="Group icon" class="w-5 h-5">
                        {{$item->group->name}}
                    </h3>
                    <div class="space-y-2">
            @endif

            @if(str_contains($item->href, 'http'))
                <a href="{{$item->href}}" target="_blank" rel="noopener noreferrer" class="group flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:shadow-md hover:border-blue-300 transition">
                    <div class="flex-1 min-w-0">
                        <span class="font-medium text-gray-900 truncate">{{$item->name}}</span>
                    </div>
                </a>
            @else
                <a href="\\{{$item->href}}" target="_blank" rel="noopener noreferrer" class="group flex items-center p-3 bg-white border border-gray-200 rounded-lg hover:shadow-md hover:border-blue-300 transition">
                    <div class="flex-1 min-w-0">
                        <span class="font-medium text-gray-900 truncate">{{$item->name}}</span>
                    </div>
                </a>
            @endif

            @php
                $previousGroup = $item->group->name
            @endphp
        @endforeach

        @if(count($links) == 0)
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-5xl mb-4 block"></i>
                <p class="text-gray-500 text-lg">No links found</p>
                <p class="text-gray-400 text-sm">Create your first link to get started</p>
            </div>
        @endif
    </div>
    </div>

@endsection
