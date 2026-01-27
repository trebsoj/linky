@extends('layout')

@section('content')

<!-- Search Bar -->
<div class="mb-6 flex flex-col sm:flex-row gap-3">
    <form method="GET" action="{{ route('group.show', $group) }}" class="flex flex-1 gap-2">
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
    <a href="{{ route('group.show', $group) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
        <i class="fas fa-times"></i>
        <span class="hidden sm:inline">Clear</span>
    </a>
    @endif
</div>

<!-- Header Section -->
<div class="mb-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
            <img src="/images/favicon.png" height="32" alt="Group icon" class="w-8 h-8">
            {{$group->name}}
        </h1>
        <div class="flex gap-2">
            <a href="{{route('group.edit',$group)}}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center gap-2">
                <i class="fas fa-pencil"></i>
                <span class="hidden sm:inline">Edit</span>
            </a>
            <form action="{{route('group.destroy', $group)}}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this group?')">
                @method('DELETE')
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition flex items-center gap-2">
                    <i class="fas fa-trash"></i>
                    <span class="hidden sm:inline">Delete</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Create Link Form -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6 border border-gray-200 dark:border-gray-700">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
        <i class="fas fa-plus-circle text-blue-600"></i>
        Add New Link
    </h2>
    <form action="{{route('link.store')}}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-3" novalidate>
        @csrf
        <input type="hidden" name="id_group" value="{{$group->id}}">

        <div>
            <input type="text" name="code" placeholder="Redirect code"
                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                id="vLinkCode"
            >
        </div>

        <div>
            <input type="text" name="name" placeholder="Name"
                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                id="vLinkName" required
            >
        </div>

        <div class="md:col-span-2">
            <input type="text" name="href" placeholder="Link URL"
                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                id="vLinkHref" required
            >
        </div>

        <div class="flex items-center">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" value="1" name="public" id="vPublic" class="w-4 h-4 text-blue-600">
                <i class="fas fa-globe text-blue-600"></i>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Public page</span>
            </label>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-lg font-medium transition flex items-center justify-center gap-2 text-sm">
            <i class="fas fa-plus"></i>
            Add
        </button>
    </form>
</div>

<!-- Links Table -->
@if(count($links) > 0)
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Public page</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($links as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        @if($item->code)
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded text-xs font-semibold">
                                <i class="fas fa-link"></i>
                                {{$item->code}}
                            </span>
                        @else
                            <span class="text-gray-400 dark:text-gray-500 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        <a href="{{$item->href}}" target="_blank" rel="noopener noreferrer" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 hover:underline">
                            {{$item->name}}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                        @if($item->public)
                            <span class="inline-flex items-center gap-1 text-green-700 dark:text-green-400">
                                <i class="fas fa-globe"></i>
                                <span class="text-xs font-semibold">Yes</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-gray-700 dark:text-gray-300">
                                <i class="fas fa-lock"></i>
                                <span class="text-xs font-semibold">No</span>
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                        <a href="{{route('link.edit', $item)}}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded inline-flex items-center gap-1 transition text-xs font-medium">
                            <i class="fas fa-pencil"></i>
                            <span class="hidden sm:inline">Edit</span>
                        </a>
                        <form action="{{route('link.destroy', $item)}}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this link?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded inline-flex items-center gap-1 transition text-xs font-medium">
                                <i class="fas fa-trash"></i>
                                <span class="hidden sm:inline">Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
    <i class="fas fa-link text-gray-300 dark:text-gray-600 text-5xl mb-4 block"></i>
    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No links in this group</p>
    <p class="text-gray-400 dark:text-gray-500 text-sm">Create your first link using the form above</p>
</div>
@endif

@endsection
