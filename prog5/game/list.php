<?php 
  require_once '../views/auth.php';
  require_once '../config/connect.php';
  require_once 'game.php';
?>
<?php
  $conn=Database::connection();
  if(isset($_POST['delete'])){
    $id=$_POST['id'];
    $query="DELETE FROM game where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $fileName=$_POST['fileName'];
    unlink("uploads/".$fileName);
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <?php include 'header.php' ?>
  <div class="container">
    <?php if($_SESSION['teacher']) {?>
      <div class="row">
        <div class="col-md-2">
          <form action="add.php">
            <button class="btn btn-secondary" type="submit">Add Game</button>
          </form>
        </div>
      </div>
    <?php } ?>
    <div class="row" style="margin-top: 20px;">
      <h3>List Game</h3>
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
              </tr>
            </thead>
              <?php 
                $listGame=Game::getAll();
                foreach ($listGame as $game) {
                  echo "<tr>";
                  echo "<td>{$game->getTitle()}</td>";
                  echo "<td>{$game->getDate()}</td>";
                  echo "<td>
                    <form action='detail.php'>
                      <button class='btn btn-primary' style='float:right;margin-right: 8px;' value=".$game->getId()." name='id'>Detail</button>
                    </form>
                    <form action='#' method='post'>
                      <input type='hidden' name='id' value=".$game->getId().">
                      <input type='hidden' name='fileName' value=".$game->getFileName().">
                      <button class='btn btn-primary' style='float:right;margin-right: 8px;' name='delete'>Delete</button>
                    </form>
                  </td>";
                  echo "</tr>";
                }
              ?>
          </table>
        </div> 
      </div>
    </div>        
  </div>
</body>

</html>