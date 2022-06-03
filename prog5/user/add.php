<?php
session_start();
if (!isset($_SESSION['teacher'])) {
    header("Location: listUser.php");
}
?>
<?php
require_once 'user.php';
if (isset($_POST['btnCreate']) && isset($_FILES["avatar"]["name"])) {
    $image = time() . "-" . $_FILES['avatar']['name'];
    $path = "avatar/";
    $path_file = $path . basename($image);
    $imageSize = $_FILES['avatar']['size'];
    $imageTmp = $_FILES['avatar']['tmp_name'];
    $allow = ['jpg', 'jpeg', 'png'];
    $imageExt = explode('.', $image);
    $imageExt = strtolower(end($imageExt));
    if (!in_array($imageExt, $allow)) {
        $mess = '<h4 style="color: red;">Upload Image Wrong!</h4>';
    }
    move_uploaded_file($_FILES['avatar']['tmp_name'], $path_file);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user = new User($username,$password,$fullname,$email,$phone,0,basename($image));

    if ($user->save()) {
        $mess = "<h4 style='color: green;'>Add User Success!</h4><p><a href='index.php'>Back To List</a></p>";
    } else {
        $mess = '<h4 style="color: red;">Add User False!</h4>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h3>
        <center><b>Add User</b></center>
    </h3>
    <?php if (isset($mess)) {
        echo $mess;
    } ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control">

        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Phone</label>
            <input type="tel" pattern="[0-9]{10}" name="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" name="btnCreate">Add</button>

    </form>
</div>


</body>
</html>