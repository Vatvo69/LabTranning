@extends('template.layout',['title'=>'Add Game'])
@section('content')
    <div class="container">
      <br>
      <h3><center>Add Game</center></h3>
      <form action="{{ route('addGame') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Title</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Hint</label>
          <textarea name="hint" rows="2" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="">File</label>
          <input type="file" name="fileGame" class="form-control-file">
          @if (session('error'))
              <div class="alert alert-danger" style="margin-top: 16px;">{{ session('error') }}</div>
          @endif
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
@endsection