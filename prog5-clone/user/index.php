<?php include '../config/auth.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include '../user/header.php' ?>
    <div class="container">
        <div class="col-sm-12">
            <h3><?php echo "Hello "?><b><?php echo $_SESSION['user']?></b></h3>
            <ul>
                <li><a href="list.php">View User Info</a></li>
                <li><a href="../classroom/index.php">View ClassRoom</a></li>
                <li><a href="#">View Game</a></li>
            </ul>
        </div>
    </div>
</body>
</html>