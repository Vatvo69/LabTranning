<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <h3>Login Page</h3>
        </div>
        <div class="card-body">
          <form action="{{route('postLogin')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="username" id="" class="form-control" placeholder="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" name="password" id="password" class="form-control" placeholder="password" required>
            </div>
            @if (session('error'))
                <h4 style="color: red;">{{session('error')}}</h4>
            @endif
            <button type="submit" class="btn btn-success">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>