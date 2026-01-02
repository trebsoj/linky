@extends('layout')


@section('content')

<form method="GET" action="{{ route('group.show', $group) }}" class="d-flex mb-3">
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

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <h3>
        <img src="/images/favicon.png" height="30px"> {{$group->name}}
    </h3>
    <div class="">
        <a  href="{{route('group.edit',$group)}}" class="btn btn-warning btn-sm px-3">
            <span class="btn-label"><i class="fa fa-pencil"></i></span>
        </a>
        <form action="{{route('group.destroy', $group)}}" method="POST" class="d-inline">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-labeled btn-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this group?')">
              <span class="btn-label"><i class="fa fa-trash"></i></span>
          </button>
        </form>
    </div>
</div>


<form action="{{route('link.store')}}" method="POST" class="row g-3 needs-validation" novalidate>
    @csrf
    <input type="hidden" name="id_group" value="{{$group->id}}">
    <div class="col-md-2">
        <input type="text" name="code" placeholder="Redirect code" class="form-control" id="vLinkCode">
        <div class="valid-feedback"></div>
    </div>
    <div class="col-md-2">
      <input type="text" name="name" placeholder="Name" class="form-control" id="vLinkName" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="col-md-5">
      <input type="text" name="href" placeholder="Link" class="form-control" id="vLinkHref" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="col-md-2 form-check">
        <input class="form-check-input" type="checkbox" value="1" name="public" id="vPublic" style="font-size: 1.8em;margin-left: -0.7em;">
        <label class="form-check-label" for="vPublic" style="margin-top: 7px;margin-left: 0.5em;"><i class="fas fa-globe"></i> Public</label>
    </div>
    <div class="col-md-1" style="text-align:center">
      <button type="submit" class="btn btn-labeled btn-success px-3">
        <span class="btn-label"><i class="fa fa-plus"></i></span>
      </button>
    </div>
</form>

@if(count($links) > 0)

    <div class="row mt-3">
        <div class="col-12 col-md-2 bold"><span>Redirect code</span></div>
        <div class="col-12 col-md-7 bold"><span>Name</span></div>
        <div class="col-12 col-md-3 bold" style="text-align:end"><span>Actions</span></div>
    </div>
    <hr>
    @foreach ($links as $item)
    <div class="row">
        <div class="col-2 col-md-2"><span>{{$item->code}}</span></div>
        <div class="col-7 col-md-7 ">
            <a href="{{$item->href}}" class="link-success" target="_blank">
                 <span class="badge bg-secondary " style="font-size: 1.1em;padding:6px;margin-bottom: 15px">
                    {{$item->name}}
                </span>
            </a>
        </div>
        <div class="col-12 col-md-3" style="text-align:end">
            <i class="fas @if($item->public) fa-globe @else fa-lock @endif"></i>
            <a href="{{route('link.edit', $item)}}" class="btn btn-warning btn-sm px-3">
                <span class="btn-label"><i class="fa fa-pencil"></i></span>
            </a>
            <form action="{{route('link.destroy', $item)}}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-sm btn-labeled btn-danger px-3" onclick="return confirm('Are you sure you want to delete this link?')">
                    <span class="btn-label"><i class="fa fa-trash"></i></span>
                </button>
            </form>
        </div>
    </div>
    <hr>
    @endforeach
@endif

@endsection
