@extends('template.layout',['title'=>'Chat'])
@section('content')
  <style>
    .well {
        margin:auto;
        font-size:15px;
        font-weight:550;
        color: #f3f3f3;
        border-bottom-left-radius: 1.3em;
        border-bottom-right-radius: 1.3em;
        border-top-left-radius: 1.3em;
        border-top-right-radius: 1.3em;
        background-color: #1fc8db;
        background-image: linear-gradient(140deg, #EADEDB 0%, #BC70A4 50%, #BFD641 75%);
    }
  </style>
  <center><h2>Chat With {{ $user->username }}</h2></center>
  <div class="container">
    @if (session('sendSuccess'))
        <div class="alert alert-success">Send Message Success!</div>
    @endif
    @if (session('editSuccess'))
        <div class="alert alert-success">Update Message Success!</div>
    @endif
    @foreach ($chats as $c)
        @if ($c->sendId==Auth::user()->id)
          <form action="{{ route('sendChat',['id'=>$c->id]) }}" method="post">
            @csrf
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading">Author: {{ Auth::user()->username }}</h4>
                <textarea name="content" rows="1" class="form-control" style="margin-bottom: 10px;">{{ $c->content }}</textarea>
                <button type="submit" class="btn btn-primary" name="editChat">Update</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Delete Message?')" name="deleteChat">Delete</button>
              </div>
            </div>
          </form>
        @elseif ($c->sendId==$user->id)
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading">Author: {{ $user->username }}</h4>
                <textarea name="contetn" id="content" rows="1" cols="5" class="form-control">{{ $c->content }}</textarea>
              </div>
            </div>
        @endif
    @endforeach
    <br>
    <div class="col-sm-7">
      <form action="{{ route('sendChat',['id'=>$user->id]) }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Send Message: </label>
          <textarea name="content" id="content" rows="1" class="form-control"></textarea>
          @error('content')
              <span class="help-block">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit" class="btn btn-success" name="sendBtn">Send</button>
      </form>
    </div>
  </div>
@endsection