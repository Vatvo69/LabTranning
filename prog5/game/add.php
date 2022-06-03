<?php
    require_once '../config/auth.php';
    require_once '../config/connect.php'
?>
<?php
    $conn=Database::connection();
    if(isset($_POST['add'])&&isset($_FILES['file']['name'])){
        if($_SESSION['teacher']){
            $path="uploads/";
        }
        $path_file=$path.basename($_FILES['file']['name']);
        $fileExt=strtolower(pathinfo($path_file,PATHINFO_EXTENSION));
        if($fileExt==='txt'){
            if($_FILES['file']['size']>2097152){
                $mess="<h4 style='color: red;'>Too Big!</h4>";
            }
            else{
                if(file_exists($path_file))
                {
                    $mess="<h4 style='color: red;'>File Exists!</h4>";
                }
                else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $path_file)) {
                        $idTeacher = $_SESSION['id'];
                        $title = $_POST['title'];
                        $hint = $_POST['hint'];
                        $fileName = $_FILES['file']['name'];
                        $query = "INSERT INTO game (idTeacher,title,hint,file) values (?,?,?,?)";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ssss", $idTeacher, $title, $hint, $fileName);
                        if ($stmt->execute()) {
                            $mess = "<h4 style='color: green;'>Upload File " . htmlspecialchars($_FILES['file']['name']) . " Success!</h4><a href='index.php'>Back To List</a>";
                        } else {
                            $mess = "<h4 style='color: red;'>Upload Error!</h4>";
                        }
                    }
                }
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'header.php'?>
    <div class="container">
        <h3><center><b>Add Game</b></center></h3>
        <?php if(isset($mess)){
            echo $mess;
        } ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Hint</label>
                <textarea name="hint" id="hint" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">File</label>
                <input type="file" name="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add</button>
        </form>
    </div>
</body>
</html>
