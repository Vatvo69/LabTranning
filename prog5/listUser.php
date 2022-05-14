<?php 
  session_start();
  include 'views/auth.php';
  require_once 'views/user.php';
?>
<?php
  if(isset($_POST['delete'])){
    $conn=Database::connection();
    $username=$_POST['delete'];
    $query="DELETE from users where username=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s",$username);
    $res=$stmt->execute();
    if($res){
      $mess="<h4 style='color: green;'>Delete User Success!</h4>";
    }
    else{
      $mess="<h4 style='color: red;'>Delete User False!</h4>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List User</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include "views/header.php" ?>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <form action="create.php">
          <button class="btn btn-secondary" type="submit">Add User</button>
        </form>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(isset($mess)){
                  echo $mess;
                }
                $listUser=User::getAll();
                foreach ($listUser as $user) {
                  echo "<tr>";
                  echo "<td>{$user->getUsername()}</td>";
                  echo "<td>{$user->getFullName()}</td>";
                  echo "<td>{$user->getEmail()}</td>";
                  echo "<td>{$user->getPhone()}</td>";
                  echo "<td>{$user->getRole()}</td>";
                  echo "<td>";
                  echo '<form action="message/message.php?name='.$user->getUsername().'" method="post" style="float: left;margin-right: 8px">'
                  .'<input type="hidden" value="'.$user->getId().'" name="recvId">'      
                  .'<button class="btn btn-primary" type="submit" name="chat" value="'.$user->getUsername().'">Chat</button></form>';
                  echo '<form action="detail.php" method="post" style="float: left;margin-right: 8px">'
                        .'<button class="btn btn-primary" type="submit" name="detail" value="'.$user->getUsername().'">Detail</button></form>';
                        ?>
                        <?php if($_SESSION['teacher']){
                          echo '<form action="profile.php" method="post" style="float: left;margin-right: 8px">'
                        .'<button class="btn btn-primary" type="submit" name="update" value="'.$user->getUsername().'">Edit</button></form>';
                        echo '<form action="#" method="post" style="float: left;margin-right: 8px">'
                        .'<button class="btn btn-primary" type="submit" name="delete" value="'.$user->getUsername().'">Delete</button></form>';
                        } ?>
                <?php
                  echo "</td>";
                  echo "</tr>";
                }
                
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>