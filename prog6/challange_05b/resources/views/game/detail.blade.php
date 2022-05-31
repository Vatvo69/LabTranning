@extends('template.layout',['title'=>'Detail Game'])
@section('content')
    <div class="container">
      <br>
      <h3><center>Detail Game</center></h3>
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" value="{{ $game->title }}" class="form-control" readonly>
      </div>
      <div class="form-group">
        <label for="">Hint</label>
        <textarea rows="5" class="form-control" readonly>{{ $game->hint }}</textarea>
      </div>
      <form action="{{ route('answerGame',['id'=>$game->id]) }}" method="post">
        @csrf
        @if (!session('mess'))
          <div class="form-group">
            <label for="">Answer</label>
            <input type="text" name="answer" class="form-control" required>
          </div>
        @endif
        @if (session('error'))
          <div class="alert alert-danger" style="margin-top: 10px;">Wrong Answer</div>
        @endif
        @if (session('mess'))
          <div class="alert alert-success" style="margin-top: 10px;">Bingo</div>
          <p><a href="{{ route('gameList') }}">Back to List</a></p>
          <textarea rows="5" class="form-control" readonly>{{ file_get_contents('game/'.$game->file.".txt") }}</textarea>
        @endif
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
      </form>
      
    </div>
@endsection