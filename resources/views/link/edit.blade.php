@extends('layout')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
        <i class="fas fa-pencil text-blue-600"></i>
        Edit Link
    </h1>
</div>

<div class="grid grid-cols-1 gap-6">
    <!-- Form Section -->
        <form action="{{route('link.update', $link->id)}}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 space-y-6" novalidate>
            @method('PUT')
            @csrf

            <!-- Link Name -->
            <div>
                <label for="vLinkName" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Link Name</label>
                <input type="text" name="name" placeholder="e.g., My Important Link"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                    id="vLinkName" value="{{$link->name}}" required
                >
            </div>

            <!-- Link URL -->
            <div>
                <label for="vLinkHref" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Link URL</label>
                <input type="text" name="href" placeholder="https://example.com"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                    id="vLinkHref" value="{{$link->href}}" required
                >
            </div>

            <!-- Redirect Code -->
            <div>
                <label for="vLinkCode" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Redirect Code
                    <span class="text-xs font-normal text-gray-500 dark:text-gray-400">Optional</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="text" name="code" placeholder="redirect-code"
                        class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                        id="vLinkCode" value="{{$link->code}}"
                    >
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Access via: <code class="bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded text-blue-700 dark:text-blue-400">{{$hostname}}/r/{{$link->code}}</code>
                </p>
            </div>

            <!-- Public Checkbox -->
            <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                <input type="checkbox" value="1" name="public" id="vPublic"
                    {{ $link->public ? 'checked="checked"' : '' }}
                    class="w-5 h-5 text-blue-600 bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500"
                >
                <label for="vPublic" class="flex items-center gap-2 cursor-pointer">
                    <i class="fas fa-eye text-blue-600"></i>
                    <span class="font-medium text-gray-700 dark:text-gray-300">Show in public page</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
                <a href="{{ URL::previous() }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>

    <!-- Logs Section -->
        @include('redirect_logs.index')
</div>

@endsection
