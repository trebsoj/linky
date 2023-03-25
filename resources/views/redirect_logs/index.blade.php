

@if(sizeof($logs) > 0)

    <h5 style="margin-top: 20px">Redirect logs </h5>
    <span>{{$logsLast24h}} request in the last 24H</span>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">IP</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($logs as $item)
        <tr>
            <td>{{$item->created_at->setTimezone('Europe/Madrid')}}</td>
            <td>{{$item->ip}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endif
