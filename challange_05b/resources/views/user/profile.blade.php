@extends('template.layout',['title'=>'Profile'])
@section('content')
<div class="container">
  <h3>Profile</h3>
  @if (session('message'))
      <div class="alert alert-success">Update Profile Success!</div>
  @endif
  <div class="container">
    <div class="text-center">
      <img src="../image/{{ $user->imagePath }}" class="img-fluid rounded-circle" style="width: 150px;height: 150px;" alt="Avatar">
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
    
  
  <div class="container">
    <a href="{{route('editProfile')}}" class="btn btn-primary">Update</a>
    <a href="{{ route('changePassword') }}" class="btn btn-info">Change Password</a>
  </div>
</div>
@endsection