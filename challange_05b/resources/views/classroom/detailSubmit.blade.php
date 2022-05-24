@extends('template.layout',['title'=>'Detail Submit'])
@section('content')
    <div class="container">
      <h3><center>Detail Submit</center></h3>
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" class="form-control" value="{{ $submit->title }}" readonly>
      </div>
      <div class="form-group">
        <label for="">Content</label>
        <textarea rows="10" class="form-control" readonly>{{ file_get_contents('classroom/student/'.$submit->file) }}</textarea>
      </div>
      <a href="{{ route('detailExercise',['id'=>$submit->exerciseId]) }}" class="btn btn-primary">Back</a>
    </div>
@endsection