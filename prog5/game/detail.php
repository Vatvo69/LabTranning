<?php require_once "../views/auth.php";
require_once "../config/connect.php"; ?>
<?php 
  $conn=Database::connection();
  $ok=0;
  if(!empty($_GET['id'])){
    $id=$_GET['id'];
    $query="SELECT * FROM game where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $res=$stmt->get_result()->fetch_assoc();
    if(isset($_POST['answer'])&&isset($_POST['submit'])){
      $answer=explode(".",$res['fileName']);
      var_dump($answer);
      if($answer[0]===$_POST['answer']){
        $ok=1;
        $mess="<h4 style='color: green;'>Bingo!</h4>";
      }else{
        $mess="<h4 style='color: red;'>Wrong Answer!</h4>";
      }
    }
  }
  else{
    header("Location: list.php");
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
    <h3>Detail Game</h3>
      <form action="#" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <?php echo '<input type="text" name="title" value="'.$res['title'].'" id="title" class="form-control" readonly>' ?>
        </div>
        <div class="form-group">
          <label for="content">Hint</label>
          <?php echo '<textarea name="content" id="content" cols="30" rows="3" class="form-control" readonly>'.$res['hint'].'</textarea>' ?>
        </div>
        <?php if($ok) 
            { ?><?php }
            else{
              ?>
            <div class="form-group">
              <label for="title">Answer</label>
              <input type="text" name="answer" class="form-control">
            </div>
        <?php } ?>
        <?php 
          if($ok){
            $path_file="uploads/".$res['fileName'];
            $content=file_get_contents($path_file);
            if(isset($mess)) {
              echo $mess;
              echo '<p><a href="list.php">Back To List</a></p>';
            }
            echo '<div class="form-group">
            <textarea name="content" id="content" cols="30" rows="3" class="form-control" readonly>'.$content.'</textarea></div>';
          } 
          else{
            if(isset($mess)) {echo $mess;}
          }
        ?>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </form>
  </div>
</body>

</html>