@extends('template.layout',['title'=>'Detail Exercise'])
@section('content')
    <div class="container">
      <br>
      <h3><center>Detail Exercise</center></h3>
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" value="{{ $exercise->title }}" class="form-control" readonly>
      </div>
      <div class="form-group">
        <label for="">Description</label>
        <textarea id="" rows="2" class="form-control" readonly>{{ $exercise->description }}</textarea>
      </div>
      <div class="form-group">
        <label for="">File: </label>
        <a href="{{ route('download',['id'=>$exercise->id]) }}">Download</a>
        @if (session('error'))
            <div class="alert alert-danger">File Not Exists!</div>
        @endif
      </div>
      <h3><center>Submit Exercise</center></h3>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Title</label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="">File</label>
          <input type="file" name="file" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
@endsection