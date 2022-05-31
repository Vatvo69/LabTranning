@extends('template.layout',['title'=>'Add Exercise'])
@section('content')

    <div class="container">
      <br>
      <h3><center>Add Exercise</center></h3>
        <form action="{{ route('addExercise') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" id="" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" rows="2" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="">File</label>
            <input type="file" name="file" id="" class="form-control">
          </div>
          @if (session('error'))
              <div class="alert alert-danger">File Not Empty!</div>
          @endif
          @if (session('errorExt'))
              <div class="alert alert-danger">Only File TXT, PDF, DOCX</div>
          @endif
          <button type="submit" class="btn btn-primary" name="addBtn">Add</button>
        </form>

      
    </div>
@endsection