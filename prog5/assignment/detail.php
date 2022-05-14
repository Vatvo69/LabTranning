<?php 
require_once '../views/auth.php';
require_once '../config/connect.php'; 
require_once 'Assignment.php';
?>
<?php
  $conn=Database::connection();
  if(isset($_POST['add'])&&isset($_FILES['file']['name'])){
    $path="uploads/submit/";
    $path_file=$path.basename($_FILES['file']['name']);
    $allow=['txt'];
    $fileExt=strtolower(pathinfo($path_file,PATHINFO_EXTENSION));
    if(in_array($fileExt,$allow)){
      if($_FILES['file']['size']>262144){
        $mess="<h5 style='color: red;'>Upload file lower than 2MB!</h5>";
      }
      else{
        if(move_uploaded_file($_FILES['file']['tmp_name'],$path_file)){
          $title=$_POST['title'];
          $idStu=$_SESSION['id'];
          $stuName=$_SESSION['user'];
          $idAssignment=$_GET['id'];
          $fileName=$_FILES['file']['name'];
          $query="INSERT INTO assignment (title,idStudent,idAssignment,studentName,fileName) values (?,?,?,?,?)";
          $stmt=$conn->prepare($query);
          $stmt->bind_param("sssss",$title,$idStu,$idAssignment,$stuName,$fileName);
          if($stmt->execute()){
            $mess="<h5 style='color: green;'>Upload FIle ".htmlspecialchars(basename($_FILES['file']['name']))." Success!<p><a href='list.php'>Back To List</a></p></h5>";
          }
          else{
            $mess="<h5 style='color: red;'>Upload Error! </h5>";
          }
        }
        else{
          $mess="<h5 style='color: red;'>Upload Error! </h5>";
        }
      }
    }else{
      $mess="<h5 style='color: red;'>Upload only file TXT</h5>";
    }
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
    <h3>Detail Assignment</h3>
    <?php 
      if(!empty($_GET['id']))
      {
        $id=$_GET['id'];
        $query="SELECT * from class where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $res=$stmt->get_result()->fetch_assoc();

      }
      else{
        header("Location: list.php");
      }
      
    ?>
      <input type="hidden" value="<?=$_SESSION['id'];?>">
      <div class="form-group">
        <label for="title">Title</label>
        <?php echo '<input type="text" name="title" value="'.$res['title'].'" id="title" class="form-control" readonly>' ?>
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <?php echo '<textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly>'.$res['content'].'</textarea>' ?>
      </div>
      <div class="form-group">
        <label for="file">File: </label>
        <?php echo '<a href="download.php?file='.$res['file'].'">Download</a>'?>
      </div>
      <?php if($_SESSION['teacher'])
        {
          ?>
          <h3>List Student Submit</h3>
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Title</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $idAssignment=$_GET['id'];
                    $query="SELECT * from assignment where idAssignment=?";
                    $stmt=$conn->prepare($query);
                    $stmt->bind_param("s",$idAssignment);
                    $stmt->execute();
                    $res=$stmt->get_result();
                    $rows=array();
                    if(mysqli_num_rows($res)>0){
                      while($row=mysqli_fetch_object($res)){
                        $a=new Assignment($row->id,$row->title,$row->date,$row->idStudent,$row->idAssignment,$row->studentName);
                        $rows[]=$a;
                      }
                    }
                    foreach ($rows as $row) {
                      echo "<tr>";
                      echo "<td>{$row->getStudentName()}</td>";
                      echo "<td>{$row->getTitle()}</td>";
                      echo "<td>{$row->getDate()}</td>";
                      echo '<td>
                    <form action="submitDetail.php">
                      <button class="btn btn-primary" type="submit" name="id" value="'.$row->getId().'">Detail</button>
                    </form></td>';
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div> 
          </div>
      <?php
        }
        else{
          ?>
          <h3>Submit Assignment</h3>
          <?php if(isset($mess)) {echo $mess;} ?>
          <form action="#" method="post" enctype="multipart/form-data">
            <?php echo '<input type="hidden" value="'.$_SESSION['id'].'">' ?>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="file">File</label>
              <input type="file" class="form-control-file" name="file">
            </div>
            <button type="submit" class="btn btn-primary" name="add" style="margin-bottom: 16px">Submit</button>
          </form>
          <?php
        }
      ?>
    </form>
  </div>
</body>

</html>