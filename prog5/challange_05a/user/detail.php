<?php
    include '../config/auth.php';
    require_once '../config/connect.php';
?>
<?php
    require_once 'user.php';

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $conn=Database::connection();
        $query="SELECT * FROM users where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $res=$stmt->get_result();
        $user=$res->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php include 'header.php' ?>
<div class="container">
    <h3>Detail</h3>
    <form action="#" method="post">
        <div class="text-center">
            <?php echo '<img class="img-fluid rounded-circle" src="avatar/'.$user['avatar'].'" style="width: 150px;height: 150px;" title="avatar">' ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <?php echo '<input type="text" name="username" id="username" class="form-control" value="'.$user['username'].'" readonly>' ?>
        </div>
        <div class="form-group">
            <label for="">Full Name</label>
            <?php echo '<input type="text" name="fullname" id="fullname" class="form-control" value="'.$user['fullname'].'" readonly >' ?>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <?php echo '<input type="text" name="email" id="email" value="'.$user['email'].'" class="form-control" readonly>' ?>
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <?php echo '<input type="text" name="phone" id="phone" value="'.$user['phone'].'" class="form-control" readonly>' ?>
        </div>
    </form>
</div>


</body>

</html>