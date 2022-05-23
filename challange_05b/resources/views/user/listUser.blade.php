@extends('template.layout',['title'=>'List User'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-2">
      @if (Auth::user()->role==1)
        <form action="{{ route('addUser') }}">
          <button class="btn btn-secondary" type="submit">Add User</button>
        </form>
      @endif
    </div>
  </div>
  <br>
  @if (session('addSuccess'))
      <div class="alert alert-success">{{ session('addSuccess') }}</div>
  @endif
  @if (session('deleteSuccess'))
      <div class="alert alert-success">{{ session('deleteSuccess') }}</div>
  @endif
  <div class="row" style="margin-top: 20px;">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Username</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $u)
                <tr>
                  <td>{{$u->username}}</td>
                  <td>{{$u->fullname}}</td>
                  <td>{{$u->email}}</td>
                  <td>{{$u->phone}}</td>
                  <td>{{$u->role}}</td>
                  <td>
                    <a href="{{ route('sendChat',['id'=>$u->id]) }}"class="btn btn-info" style="float: left;margin-right: 8px;">Chat</a>
                    <a href="{{route('detailUser',['id'=>$u->id])}}" class="btn btn-info" style="float: left;margin-right: 8px;">Detail</a>
                    @if (Auth::user()->role==1)
                    <a href="{{route('editUser',['id'=>$u->id])}}" class="btn btn-info" style="float: left;margin-right: 8px;">Edit</a>
                    <a href="{{route('deleteUser',['id'=>$u->id])}}" class="btn btn-info" style="float: left;margin-right: 8px" onclick="return confirm('Delete this account?')" style="color: white;float: right;">Delete</a>
                    @endif
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection