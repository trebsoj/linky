@if(sizeof($logs) > 0)
<div class="rounded-lg shadow-md overflow-hidden bg-white dark:bg-gray-800 ">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="font-semibold  text-gray-900 dark:text-gray-100 flex items-center gap-2">
            <i class="fas fa-chart-line text-blue-600"></i>
            Redirect Logs
        </h3>
        <p class="text-sm text-gray-900 dark:text-gray-100 mt-1">
            <span class="font-semibold text-green-600">{{$logsLast24h}}</span> requests in the last 24 hours
        </p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach ($logs as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-4 py-3 text-gray-700">
                        <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded text-xs font-semibold">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                            {{$item->created_at->setTimezone('Europe/Madrid')->format('Y-m-d H:i:s')}}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-700">
                        <code class="px-2 py-1 rounded text-xs font-mono bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300">{{$item->ip}}</code>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
