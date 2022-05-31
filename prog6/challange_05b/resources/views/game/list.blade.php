@extends('template.layout',['title'=>'List Game'])
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          @if (Auth::user()->role==1)
            <form action="{{ route('addGame') }}" method="get">
              <button type="submit" class="btn btn-secondary">Add Game</button>
            </form>
          @endif
        </div>
      </div>
      <br>
      <h3><center><b>List Game</b></center></h3>
      @if (session('addSuccess'))
          <div class="alert alert-success">Add New Game Success!</div>
      @endif
      @if (session('deleteSuccess'))
        <div class="alert alert-success">Delete Game Success!</div>
      @endif
      <div class="row" style="margin-top: 20px">
        <div class="col-sm-12">
          <div class="table-response">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Time Create</th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($game))
                    @foreach ($game as $g)
                        <tr>
                          <td>{{ $g->title }}</td>
                          <td>{{ $g->created_at }}</td>
                          <td>
                            <a href="{{ route('detailGame',['id'=>$g->id]) }}" class="btn btn-info" style="float: right;margin-left: 16px;">Detail</a>
                            @if (Auth::user()->role==1)
                              <a href="{{ route('deleteGame',['id'=>$g->id]) }}" class="btn btn-info" onclick="return confirm('Delete Game?');" style="float: right;">Delete</a>
                            @endif
                          </td>
                          
                        </tr>
                    @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
@endsection