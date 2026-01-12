@extends('layout')

@section('content')

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

        <a href="{{$item->href}}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg hover:shadow-md hover:border-blue-300 transition">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <span class="text-blue-600 text-lg">
                    <i class="fas fa-link"></i>
                </span>
                <span class="font-medium text-gray-900 truncate">{{$item->name}}</span>
            </div>
            <i class="fas fa-external-link-alt text-gray-400 group-hover:text-blue-600 transition ml-2 flex-shrink-0"></i>
        </a>

        @php
            $previousGroup = $item->group->name
        @endphp
    @endforeach
</div>

@endsection
