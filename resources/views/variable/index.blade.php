@extends('layout')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
        <i class="fas fa-dollar-sign text-amber-500"></i>
        Variables
    </h1>
    <p class="text-gray-600 dark:text-gray-400 mt-2">Define global variables to use in your links</p>
</div>

<!-- Create Variable Form -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6 border border-gray-200 dark:border-gray-700">
    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
        <i class="fas fa-plus-circle text-blue-600"></i>
        Add New Variable
    </h2>
    <form action="{{route('variable.store')}}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-3" novalidate>
        @csrf
        <div class="md:col-span-2">
            <input type="text" name="key" placeholder="Variable key (e.g., @{{BASE_URL}})" 
                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                required
            >
        </div>
        <div class="md:col-span-2">
            <input type="text" name="value" placeholder="Variable value" 
                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                required
            >
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-lg font-medium transition flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i>
            Add
        </button>
    </form>
</div>

<!-- Variables Table -->
@if(count($variables) > 0)
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Key</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($variables as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        <code class="bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded text-xs text-blue-700 dark:text-blue-400">{{$item->key}}</code>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                        <code class="bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded text-xs">{{$item->value}}</code>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                        <a href="{{route('variable.edit', $item)}}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded inline-flex items-center gap-1 transition text-xs font-medium">
                            <i class="fas fa-pencil"></i>
                            Edit
                        </a>
                        <form action="{{route('variable.destroy', $item)}}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this variable?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded inline-flex items-center gap-1 transition text-xs font-medium">
                                <i class="fas fa-trash"></i>
                                Delete
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
    <i class="fas fa-dollar-sign text-gray-300 dark:text-gray-600 text-5xl mb-4 block"></i>
    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No variables yet</p>
    <p class="text-gray-400 dark:text-gray-500 text-sm">Create your first variable using the form above</p>
</div>
@endif

@endsection
