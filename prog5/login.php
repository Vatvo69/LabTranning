<?php session_start(); 
  require_once 'views/permission.php';
  if(isset($_POST['username']) && isset($_POST['password'])){
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $perm=new Permission($user,$pass);
    $teacher=$perm->teacherCheck();
    $student=$perm->studentCheck();
    if($teacher||$student){
      $_SESSION['teacher']=$teacher;
      $_SESSION['student']=$student;
      $_SESSION['user']=$user;
      $_SESSION['id']=$perm->getId();
      header("Location: index.php");
      die();
    }
    else{
      $mess='<h4 style="color: red">Sai username hoac password!</h4>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <h3>Login</h3>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <input type="submit" class="btn">
          </form>
          <?php if(isset($mess)){
            echo $mess;
          }
            ?>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
</script>

</html>