<?php
  require_once '../views/auth.php';
  require_once 'mess.php';
  require_once '../config/connect.php';

?>
<?php
  if(isset($_POST['recvId'])){
    $_SESSION['recvId']=$_POST['recvId'];
  }
  if(isset($_POST['update'])){
    $content=$_POST['content'];
    $id=$_POST['id'];
    $conn=Database::connection();
    $query="UPDATE message set content=? where id=? ";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ss",$content,$id);
    $res=$stmt->execute();
  }
  else if(isset($_POST['delete']))
  {
    $sendId=$_POST['sendId'];
    $recvId=$_POST['recvId'];
    $id=$_POST['id'];
    $conn=Database::connection();
    $query="DELETE from message where sendId=? and recvId=? and id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("sss",$sendId,$recvId,$id);
    $res=$stmt->execute();
  }
  $conn=Database::connection();
  $query="SELECT username from users where id=?";
  $stmt=$conn->prepare($query);
  $stmt->bind_param("s",$_SESSION['id']);
  $res=$stmt->execute();
  $sender=$stmt->get_result()->fetch_assoc();

  $query="SELECT username from users where id=?";
  $stmt=$conn->prepare($query);
  $stmt->bind_param("s",$_SESSION['recvId']);
  $res=$stmt->execute();
  $recver=$stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg static-top">
      <div class="container">
          <div class="col-sm-7">
              <h1>
                  <a href="../index.php" style="text-decoration: none;">Management System</a>
              </h1>
          </div>
          <div class="navbar-collapse col-sm-6">
              <div class="navbar-nav ml-auto">
                  <?php if(isset($_SESSION['teacher']) || isset($_SESSION['student'])) {?>
                  <a class="nav-item btn btn-danger" href="../profile.php" style="margin-right: 7px;">
                      Profile
                  </a>
                  <a class="nav-item btn btn-danger" href="../logout.php">
                      Logout
                  </a>
                  <?php } ?>
              </div>
          </div>
      </div>
  </nav>
  <br>
  <?php echo '<center><h2>Chat With '.$recver['username'].'</h2></center>' ?>
  <div class="container">
      <?php
        $sendId=$_SESSION['id'];
        $recvId=$_SESSION['recvId'];
        $conn=Database::connection();
        $query="SELECT * from message where recvId=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$recvId);
        $res=$stmt->execute();
        $res=$stmt->get_result();
        $rows=[];
        if(mysqli_num_rows($res)>0){
          while($row=mysqli_fetch_object($res)){
            $mess=new Mess($row->id,$row->sendId,$row->recvId,$row->content,$row->author);
            $rows[]=$mess;
          }
        }
        foreach ($rows as $row) {
          echo '<form action="#" method="post" enctype="multipart/form-data">
          <div class="form-group">
                <input type="hidden" name="sendId" value="'.$row->getSendId().'"> 
                <input type="hidden" name="recvId" value="'.$row->getRecvId().'">
                <input type="hidden" name="id" value="'.$row->getId().'">
                <label for="author">Author: '.$row->getAuthor().'</label>
                <textarea name="content" rows="1" class="form-control" style="margin-bottom: 10px">'.$row->getContent().'</textarea>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                <button type="submit" class="btn btn-primary" name="delete">Delete</button>
            </div>
          </form>';
        }
      ?>
    <div class="col-sm-7">
      <form action="send.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <?php echo '<input type="hidden" value="'.$_SESSION['recvId'].'" name="recvId">
          <input type="hidden" value="'.$_SESSION['user'].'" name="author">'
          ?>
          <label for="">Send Message: </label>
          <textarea name="content" id="message" rows="1" class="form-control"></textarea>
        </div>
        <p style="color: green;">
          <?php if(isset($_GET['status'])&&$_GET['status']=='success') echo "Send!";?>
        </p>
        <p style="color: red;">
          <?php if(isset($_GET['status'])&&$_GET['status']=='fail') echo "Error!" ?>
        </p>
        <button type="submit" name="send" class="btn btn-success">Send</button>
      </form>
    </div>
  </div>
</body>

</html>