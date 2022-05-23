@extends('template.layout',['title'=>'Detail'])
@section('content')
    <div class="container">
      <h3>User {{$user->username}}</h3>
      @if (session('updateSuccess'))
          <div class="alert alert-success">{{ session('updateSuccess') }}</div>
      @endif
      <div class="container">
        <div class="text-center">
          <img src="../../image/{{ $user->imagePath }}" class="img-fluid rounded-circle" style="width: 150px;height: 150px;" alt="Avatar">
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="">Full Name</label>
          <input type="text" name="fullname" id="fullname" value="{{$user->fullname}}" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="">Phone</label>
          <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control" readonly>
        </div>
      </div>
    </div>
@endsection