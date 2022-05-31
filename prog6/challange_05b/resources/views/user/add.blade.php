@extends('template.layout',['title'=>'Add User'])
@section('content')
<div class="container">
    <br>
  <h3><center>Add User</center></h3>
  @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif 
  <form action="#" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="password">Password</label>
          <input type="text" name="password" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="image">Avatar</label>
        <input type="file" name="image" id="image" class="form-control">
        
      </div>
      <div class="form-group">
          <label for="fullname">Full Name</label>
          <input type="text" name="fullname" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="email">Phone</label>
          <input type="tel" pattern="[0-9]{10}" name="phone" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary" name="btnCreate">Add</button>
  </form>
</div>
@endsection