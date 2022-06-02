<?php
    require_once '../config/auth.php';
    require_once '../config/connect.php';
    require_once 'submit.php'
?>
<?php
    $conn=Database::connection();
    if(isset($_POST['add'])&&isset($_FILES['file']['name'])){
        $path="uploads/student/";
        $allow=['txt'];
        $file=time().'_'.basename($_FILES['file']['name']);
        $path_file=$path.$file;
        $fileExt=strtolower(pathinfo($path_file,PATHINFO_EXTENSION));
        if(in_array($fileExt,$allow)){
            if($_FILES['file']['size']>262144){
                $mess="<h5 style='color: red;'>Upload file lower than 2MB!</h5>";
            }
            else{
                if(move_uploaded_file($_FILES['file']['tmp_name'],$path_file)){
                    $title=$_POST['title'];
                    $idStudent=$_SESSION['id'];
                    $idExercise=$_GET['id'];
                    $studentName=$_SESSION['user'];

                    $query="INSERT INTO submit (title,idStudent,idExercise,studentName,file) VALUES (?,?,?,?,?)";
                    $stmt=$conn->prepare($query);
                    $stmt->bind_param('sssss',$title,$idStudent,$idExercise,$studentName,$file);
                    if($stmt->execute()){
                        $mess="<h5 style='color: green;'>Upload FIle ".htmlspecialchars(basename($_FILES['file']['name']))." Success!<p><a href='index.php'>Back To List</a></p></h5>";
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
    elseif (isset($_POST['delete']))
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Exercise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'?>
    <div class="container">
        <h3><center><b>Detail Exercise</b></center></h3>
        <?php
            $conn=Database::connection();
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $query="SELECT * FROM class WHERE id=?";
                $stmt=$conn->prepare($query);
                $stmt->bind_param("s",$id);
                $stmt->execute();
                $res=$stmt->get_result()->fetch_assoc();
                if(is_null($res)){
                    header("Location: index.php");
                }
            }


        ?>
        <div class="form-group">
            <label for="">Title</label>
            <?php echo "<input type='text' class='form-control' readonly value='{$res['title']}'>"?>
        </div>
        <div class="form-group">
            <label for="">Content</label>
            <?php echo '<textarea cols="30" rows="5" class="form-control" readonly>'.$res['content'].'</textarea>';?>
        </div>
        <div class="form-control-file">
            <label for="">File</label>
            <?php echo "<a href=\"download.php?file={$res['file']}\">Download</a>" ?>
        </div>
        <br>
        <?php if($_SESSION['student']){
            ?>
            <h3><center><b>Submit Exercise</b></center></h3>
            <?php if(isset($mess)) echo $mess; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label for="">File: </label>
                    <input type="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary" name="add">Submit</button>
            </form>
            <?php
        }
        else{
            ?>
            <h3><center><b>List Submit</b></center></h3>
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
                            $id=$_GET['id'];
                            $query="SELECT * FROM submit where idExercise=?";
                            $stmt=$conn->prepare($query);
                            $stmt->bind_param("s",$id);
                            $stmt->execute();
                            $res=$stmt->get_result();
                            $rows=array();
                            if(mysqli_num_rows($res)>0){
                                while($row=mysqli_fetch_object($res)){
                                    $s=new Submit($row->id,$row->title,$row->idStudent,$row->idExercise,$row->studentName,$row->file,$row->date);
                                    $rows[]=$s;
                                }
                            }
                            foreach ($rows as $r){
                                echo "<tr>";
                                echo "<td>{$r->getStudentName()}</td>";
                                echo "<td>{$r->getTitle()}</td>";
                                echo "<td>{$r->getDate()}</td>";
                                echo "<td>
                                            <a href=\"detailSubmit.php?id={$r->getId()}\" class=\"btn btn-primary\" style='float: right;margin-right: 8px'>Detail</a>
                                            <form action=\"\" method=\"post\">
                                                <button type=\"submit\" class='btn btn-primary' style='float: right;margin-right: 8px' onclick=\"return confirm('Delete Submit ?')\">Delete</button>
                                            </form>
                                      </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>

                </table>
            </div>
            <?php
        }
        ?>


    </div>
</body>
</html>
