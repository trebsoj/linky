@extends('layout')


@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <h3><img src="/images/favicon.png" height="30px"> Edit group</h3>
</div>


<form action="{{route('group.update', $group->id)}}" method="POST" class="row g-3 needs-validation" novalidate>
    @method('PUT')
    @csrf
    <div class="col-md-12">
      <label>Name</label>
      <input type="text" name="name" placeholder="Name" class="form-control" id="vGroupName" value="{{$group->name}}" required>
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

@endsection
