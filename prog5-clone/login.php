<?php session_start();
    require_once 'config/permission.php';
    if(isset($_POST['username'])&&isset($_POST['password'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $perm=new Permission($username,$password);
        $teacher=$perm->teacherCheck();
        $student=$perm->studentCheck();
        if($teacher||$student){
            $_SESSION['teacher']=$teacher;
            $_SESSION['student']=$student;
            $_SESSION['user']=$username;
            header("Location: index.php");
            die();
        }
        else{
            $mess="<h4 style='color: red'>Wrong Username or Password</h4>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <div class="container">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3>Login Page</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" id="" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<body>
  
</body>

</html>