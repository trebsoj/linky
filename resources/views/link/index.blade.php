@extends('layout')

@section('content')

    <form method="GET" action="{{ route('home') }}" class="d-flex mb-3">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search" class="form-control me-2" style="max-width: 300px;">
        <button type="submit" class="btn btn-labeled btn-success px-3 me-2">
            <span class="btn-label"><i class="fa fa-search"></i></span>
        </button>
        @if($search ?? '')
        <button type="button" class="btn btn-labeled btn-secondary px-3" onclick="this.previousElementSibling.previousElementSibling.value=''; this.form.submit();">
            <span class="btn-label"><i class="fa fa-times"></i></span>
        </button>
        @endif
    </form>

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
