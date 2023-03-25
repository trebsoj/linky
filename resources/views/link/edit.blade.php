@extends('layout')


@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <h3><img src="/images/favicon.png" height="30px"> Edit link</h3>
</div>


<form action="{{route('link.update', $link->id)}}" method="POST" class="row g-3 needs-validation" novalidate>
    @method('PUT')
    @csrf
    <div class="form-check" style="margin-top: 37px;padding-left: 50px;">
        <input class="form-check-input" type="checkbox" value="1" name="public" id="vPublic" {{ $link->public ? 'checked="checked"' : '' }} style="font-size: 1.8em">
        <label class="form-check-label" for="vPublic" style="margin-top: 7px"><i class="fas fa-globe"></i> Public</label>
    </div>
    <div>
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" id="vLinkName" value="{{$link->name}}" required>
        <div class="valid-feedback"></div>
    </div>
    <div>
        <label >Link</label>
        <input type="text" name="href" placeholder="Link" class="form-control" id="vLinkHref" value="{{$link->href}}" required>
        <div class="valid-feedback"></div>
    </div>
    <div>
        <label>Redirect code <span style="font-style: italic;color: cornflowerblue;">{{$hostname}}/r/[redirect_code]</span></label>
        <input type="text" name="code" placeholder="Code" class="form-control" id="vLinkCode" value="{{$link->code}}">
        <div class="valid-feedback"></div>
    </div>
    <div class="col-6"style="text-align:end">
        <button type="submit" class="btn btn-labeled btn-success px-4">
          <span class="btn-label"><i class="fa fa-save"></i></span>
        </button>
    </div>
    <div class="col-6" >
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-block px-4">
            <span class="btn-label"><i class="fa fa-times"></i></span>
        </a>
    </div>
</form>

@include('redirect_logs.index')

@endsection
