@extends('template.layout',['title'=>'Edit Profile'])
@section('content')
    <div class="container">
      <h3>Edit Profile</h3>
      @if (session('error'))
          <div class="alert alert-danger">
            {{session('error')}}
          </div>
      @endif
      <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control" @if (Auth::user()->role==0)
          readonly
          @endif>
          @error('username')
              <span class="help-block">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Full Name</label>
          <input type="text" name="fullname" id="fullname" value="{{$user->fullname}}" class="form-control" @if (Auth::user()->role==0)
              readonly
          @endif>
          @error('fullname')
              <span class="help-block">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control">
          @error('email')
              <span class="help-block">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Phone</label>
          <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control">
          @error('phone')
              <span class="help-block">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Image</label>
          <input type="file" name="image" id="" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
      </form>
    </div>
@endsection