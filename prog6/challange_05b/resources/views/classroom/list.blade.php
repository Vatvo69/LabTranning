@extends('template.layout',['title'=>'List Exercise'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-2">
      @if (Auth::user()->role==1)
        <form action="{{ route('addExercise') }}">
          <button class="btn btn-secondary" type="submit">Add Exercise</button>
        </form>
      @endif
    </div>
  </div>
  <br>
  @if (session('addSuccess'))
      <div class="alert alert-success">Add Exercies Success!</div>
  @endif
  @if (session('deleteSuccess'))
      <div class="alert alert-success">Delete Exercies Success!</div>
  @endif
  <h3><center><b>List Exercise</b></center></h3>
  <div class="row" style="margin-top: 20px;">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($exercise as $e)
                <tr>
                  <td>{{ $e->title }}</td>
                  <td>{{ $e->created_at }}</td>
                  <td>
                    @if (Auth::user()->role==1)
                      <a href="{{ route('deleteExercise',['id'=>$e->id]) }}" class="btn btn-info" style="float: right;margin-left: 16px;" onclick="return confirm('Delete Exercies?')">Delete</a>
                    @endif
                    <a href="{{ route('detailExercise',['id'=>$e->id]) }}" class="btn btn-info" style="float: right;">Detail</a>
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