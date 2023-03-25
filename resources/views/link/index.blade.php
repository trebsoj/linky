@extends('layout')

@section('content')

    @php
        $previousGroup = ''
    @endphp

    @foreach ($links as $item)
        @if($previousGroup <> $item->group->name)
            <h4 style="margin-top: 20px"><img src="/images/favicon.png" height="25px">{{$item->group->name}}</h4>
        @endif

        @if(str_contains($item->href, 'http'))
            <a href="{{$item->href}}" class="link-success" target="_blank" style="text-decoration: inherit;margin-left: 10px">
                <span class="badge bg-secondary " style="font-size: 1.1em;padding:6px;margin-bottom: 15px">
                    {{$item->name}}
                </span>
            </a>
        @else
            <a href="\\{{$item->href}}" class="link-success" target="_blank" style="text-decoration: inherit;margin-left: 10px">
                <span class="badge bg-secondary " style="font-size: 1.1em;padding:6px;margin-bottom: 15px">
                    {{$item->name}}
                </span>
            </a>
        @endif

        @php
            $previousGroup = $item->group->name
        @endphp
    @endforeach

@endsection
