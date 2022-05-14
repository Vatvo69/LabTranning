<?php include "views/auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>
  <?php include 'views/header.php'; ?>
  <div class="container">
    <div class="col-sm-12">
      <h3>
        <?php
          echo "Hello ".$_SESSION['user'];
        ?>
      </h3>
      <ul>
        <li><a href="listUser.php">View User Info</a></li>
        <li><a href="assignment/list.php">View assignments</a></li>
        <li><a href="game/list.php">View game</a></li>
      </ul>
    </div>
  </div>
</body>

</html>