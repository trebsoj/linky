@if(sizeof($logs) > 0)
<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="p-4 border-b border-gray-200">
        <h3 class="font-semibold text-gray-900 flex items-center gap-2">
            <i class="fas fa-chart-line text-blue-600"></i>
            Redirect Logs
        </h3>
        <p class="text-sm text-gray-600 mt-1">
            <span class="font-semibold text-green-600">{{$logsLast24h}}</span> requests in the last 24 hours
        </p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach ($logs as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-700">
                        <span class="inline-flex items-center gap-1">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                            {{$item->created_at->setTimezone('Europe/Madrid')->format('Y-m-d H:i:s')}}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-700">
                        <code class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">{{$item->ip}}</code>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
