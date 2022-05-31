@extends('template.layout',['title'=>'Change Password'])
@section('content')
    <div class="container">
      @if (session('updateSuccess'))
          <div class="alert alert-success">Update Password Success!</div>
      @endif
      <form action="{{ route('updatePassword') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Change Password</label>
          <input type="text" name="password" id="" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
@endsection