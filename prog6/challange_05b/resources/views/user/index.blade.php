@extends('template.layout',['title'=>'Home Page'])
@section('content')
    <div class="container">
      <div class="col-sm-12">
        <h3>Hello <b>{{Auth::user()->username}}</b></h3>
        <ul>
          <li><a href="{{route('listUser')}}">View UserInfo</a></li>
          <li><a href="{{ route('exerciseList') }}">View ClassRoom</a></li>
          <li><a href="{{ route('gameList') }}">View Game</a></li>
        </ul>
      </div>
    </div>
@endsection