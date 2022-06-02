<?php
    require_once '../config/auth.php';
    require_once '../config/connect.php';
?>
<?php
if(isset($_POST['add'])&&isset($_FILES['file'])){
    if($_SESSION['teacher']){
        $path="uploads/teacher/";
    }
    $filename=time().'_'.basename($_FILES['file']['name']);
    $path_file=$path.$filename;
    $allow=['txt','pdf','docx'];
    $fileExt=strtolower(pathinfo($path_file,PATHINFO_EXTENSION));
    if(in_array($fileExt,$allow)){
        if ($_FILES['file']['size']>1310720){
            $mess="<h4 style='color: red;'>Upload file lower than 10MB!</h4>";
        }
        else{
            if(move_uploaded_file($_FILES['file']['tmp_name'],$path_file)){
                $mess="<h4 style='color: green;'>Upload File ".htmlspecialchars(basename($_FILES['file']['name']))." Success!</h4>
                       <p><a href='index.php'>Back To List</a></p>";
                $idTeacher=$_SESSION['id'];
                $title=$_POST['title'];
                $content=$_POST['content'];
                $conn=Database::connection();
                $query="INSERT INTO class (idTeacher,title,content,file) values (?,?,?,?)";
                $stmt=$conn->prepare($query);
                $stmt->bind_param("ssss",$idTeacher,$title,$content,$filename);
                $stmt->execute();
                $stmt->close();
            }
            else{
                $mess="<h4 style='color: red;'>Upload Error!</h4>";
            }
        }
    }
    else{
        $mess="<h4 style='color: red;'>Upload Allow TXT, PDF, DOCX</h4>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
<?php include 'header.php' ?>
<div class="container">
    <h3><center><b>Add Exercise</b></center></h3>
    <?php if(isset($mess)) {echo $mess;} ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control-file" name="file">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add</button>
    </form>
</div>
</body>

</html>