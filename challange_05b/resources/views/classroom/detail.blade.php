@extends('template.layout',['title'=>'Detail Exercise'])
@section('content')
    <div class="container">
      <br>
      <h3><center>Detail Exercise</center></h3>
      @if (session('submitSuccess'))
          <div class="alert alert-success">Submit Success!</div>
      @endif
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
      @if (Auth::user()->role!=1)
        <h3><center>Submit Exercise</center></h3>
        <form action="{{ route('saveSubmit',['id'=>$exercise->id]) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">File</label>
            <input type="file" name="fileSubmit" class="form-control-file">
            @if (session('errorSubmit'))
                <div class="alert alert-danger" style="margin-top: 10px;">{{ session('errorSubmit') }}</div>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      @else
      <h3><center>List Submiter</center></h3>
      @if (session('deleteSuccess'))
          <div class="alert alert-success">Delete Submit Success!</div>
      @endif
      <div class="container">
        <div class="table-response">
          <table class="table">
            <thead>
              <tr>
                <th>Name Student</th>
                <th>Title</th>
                <th>Time Submit</th>
              </tr>
            </thead>
            <tbody>
                @if (!empty($submit))
                  @foreach ($submit as $s)
                  <tr>
                    <td>{{ $s->studentName }}</td>
                    <td>{{ $s->title }}</td>
                    <td>{{ $s->created_at }}</td>  
                    <td><a href="{{ route('detailSubmit',['id'=>$s->id]) }}" class="btn btn-info" style="float: right;">Detail</a></td>
                    <td><a href="{{ route('deleteSubmit',['id'=>$s->id]) }}" class="btn btn-info" onclick="return confirm('Delete Sumbit?')">Delete</a></td>
                  </tr>
                  @endforeach
                @endif
            </tbody>
          </table>
        </div>
      </div>
      @endif
      
    </div>
@endsection