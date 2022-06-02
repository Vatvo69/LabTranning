<?php
include '../config/auth.php';
require_once '../config/connect.php';
?>
<?php
require_once 'user.php';
    if(isset($_POST['btnUpdate'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $fullname=$_POST['fullname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $avatar=$_POST['avatar'];
        if(empty($username) || empty($password) || empty($fullname) || empty($email) || empty($phone)){
            $mess='<h4 style="color: red;">Update User False!</h4>';
        }
        else{

            if(!empty($_FILES['avatar']['name']))
            {
                $image=time()."-".$_FILES['avatar']['name'];
                $path="avatar/";
                $path_file=$path.basename($image);
                $imageSize=$_FILES['avatar']['size'];
                $imageTmp=$_FILES['avatar']['tmp_name'];

                $allow=['jpg','jpeg','png'];
                $imageExt=explode('.',$image);
                $imageExt=strtolower(end($imageExt));
                if(!in_array($imageExt,$allow)){
                    $mess='<h4 style="color: red;">Upload Image Wrong!</h4>';
                }
                else{
                    move_uploaded_file($_FILES['avatar']['tmp_name'],$path_file);
                    $user1=new User($username,$password,$fullname,$email,$phone,0,basename($image));

                    if($user1->update()){
                        $mess='<h4 style="color: green;">Update User Success!</h4>';
                    }
                    else{
                        $mess='<h4 style="color: red;">Update User False!</h4>';
                    }
                }
            }
            else{
                $user1=new User($username,$password,$fullname,$email,$phone,0,$avatar);
                if($user1->update()){
                    $mess='<h4 style="color: green;">Update User Success!</h4>';
                }
                else{
                    $mess='<h4 style="color: red;">Update User False!</h4>';
                }
            }
        }
    }
    else{
        if(isset($_POST['update'])){
            $username=$_POST['update'];
        }
        elseif (isset($_POST['editBtn'])){
            $username=$_POST['editBtn'];
        }
        else{
            $username=$_SESSION['user'];
        }
    }
    $conn=Database::connection();
    $query="SELECT username,password,fullname,email,phone,avatar from users where username=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s",$username);
    $ret=$stmt->execute();
    $result=$stmt->get_result();
    $user=$result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    $stmt->close();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php include 'header.php' ?>
<div class="container">
    <h3>Profile</h3>
    <form action="#" method="post" enctype="multipart/form-data">
        <?php echo '<input type="hidden" name="avatar" value="'.$user['avatar'].'">' ?>
        <div class="text-center">
            <?php echo '<img class="img-fluid rounded-circle" src="avatar/'.$user['avatar'].'" style="width: 150px;height: 150px;" title="avatar">' ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <?php echo '<input type="text" name="username" id="username" class="form-control" value="'.$username.'" readonly>' ?>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <?php echo '<input type="password" name="password" id="password" class="form-control" value="'.$user['password'].'">' ?>
        </div>
        <div class="form-group">
            <label for="">Full Name</label>
            <?php echo '<input type="text" name="fullname" id="fullname" class="form-control" value="'.$user['fullname'].'" readonly >' ?>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <?php echo '<input type="text" name="email" id="email" value="'.$user['email'].'" class="form-control">' ?>
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <?php echo '<input type="text" name="phone" id="phone" value="'.$user['phone'].'" class="form-control">' ?>
        </div>
        <div class="form-group">
            <label for="avatar">Image</label>
            <input type="file" name="avatar" id="avatar"  class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
        <?php if(isset($mess)) {echo $mess;} ?>
    </form>
</div>


</body>

</html>