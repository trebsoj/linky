@extends('layout')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
        <i class="fas fa-pencil text-blue-600"></i>
        Edit Group
    </h1>
</div>

<div class="max-w-2xl">
    <form action="{{route('group.update', $group->id)}}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700 space-y-6" novalidate>
        @method('PUT')
        @csrf

        <!-- Group Name -->
        <div>
            <label for="vGroupName" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Group Name</label>
            <input type="text" name="name" placeholder="e.g., Work Links"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
                id="vGroupName" value="{{$group->name}}" required
            >
        </div>

        <!-- Enable Random -->
        <div class="flex items-center gap-3">
            <input type="checkbox" name="enable_random" id="enable_random" value="1"
                {{ $group->enable_random ? 'checked' : '' }}
                class="w-5 h-5 text-blue-600 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 bg-white dark:bg-gray-900"
            >
            <label for="enable_random" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                Random route <code class="bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded text-blue-700 dark:text-blue-400">{{$hostname}}/group/{{$group->id}}/random</code>
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
</div>

@endsection
