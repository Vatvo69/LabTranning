<?php 
  require_once '../views/auth.php';
  require_once '../config/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Submit</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <?php include 'header.php' ?>
  <?php 
    $conn=Database::connection();
    $id=$_GET['id'];
    $query="SELECT * from assignment where id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $res=$stmt->get_result()->fetch_assoc();
    $fileName=$res['fileName'];
    $path_file="uploads/submit/".$fileName;
    $content=file_get_contents($path_file);
  ?>
  <center><h3>Sumit By <?=$res['studentName']?></h3></center>
  <div class="container">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="<?=$res['title']?>" class="form-control" readonly>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly><?=$content?></textarea>
    </div>
  </div>
</body>

</html>