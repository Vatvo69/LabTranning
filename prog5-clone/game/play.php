<?php require_once '../config/auth.php';
    require_once '../config/connect.php';
?>
<?php
    $ok=0;
    if(!empty($_GET['id'])&&is_numeric($_GET['id'])){
        $conn=Database::connection();
        $id=$_GET['id'];
        $query="SELECT * FROM game where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $res=$stmt->get_result()->fetch_assoc();
        if(isset($_POST['submit'])&&isset($_POST['answer'])){
            $answer=explode(".",$res['file']);
            if($answer[0]===$_POST['answer']){
                $ok=1;
                $mess="<h4 style='color: green;'>Bingo!</h4>";
            }
            else{
                $mess="<h4 style='color: red;'>Wrong Answer!</h4>";
            }
        }
    }
    else{
        header("Location: index.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Play</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <?php require_once 'header.php'?>
    <div class="container">
        <h3><center><b>Play</b></center></h3>

        <div class="col-sm-12">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Title</label>
                    <?php echo '<input type="text" value="'.$res['title'].'" class="form-control" readonly>'; ?>
                </div>
                <div class="form-group">
                    <label for="">Hint</label>
                    <?php echo '<textarea cols="30" rows="5" class="form-control" readonly>'.$res['hint'].'</textarea>'; ?>
                </div>
                <?php if($ok){
                    $path="uploads/".$res['file'];
                    $content=file_get_contents($path);
                    if (isset($mess)) {
                        echo $mess;
                    }
                    echo '<div class="form-group">
                    <textarea name="content" id="content" cols="30" rows="5" class="form-control" readonly>'.$content.'</textarea></div>';
                    echo '<a href="index.php" class="btn btn-primary">Back To List</a>';
                } else{
                    ?>
                        <?php if(isset($mess)){
                            echo $mess;
                    }?>
                    <div class="form-group">
                        <label for="">Answer</label>
                        <input type="text" name="answer" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <?php
                } ?>
            </form>

        </div>

    </div>
</body>
</html>