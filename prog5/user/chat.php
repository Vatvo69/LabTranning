<?php
    require_once '../config/auth.php';
    require_once '../config/connect.php';
    require_once  'message.php';
?>
<?php
    $conn=Database::connection();
    if(isset($_GET['id'])&&is_numeric($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT * FROM users where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $res=$stmt->get_result()->fetch_assoc();
        if(isset($_POST['send'])){
            $recvId=$id;
            $sendId=$_SESSION['id'];
            $content=$_POST['content'];
            $author=$_SESSION['user'];
            $mess=new Message($id,$sendId,$recvId,$content,$author);
            $query="INSERT INTO message (sendId,recvId,content,author) VALUES (?,?,?,?)";
            $stmt=$conn->prepare($query);
            $stmt->bind_param("ssss",$sendId,$recvId,$content,$author);
            if($stmt->execute()){
                $mess="<h4 style='color: green'>Send Success!</h4>";
            }
            else{
                $mess="<h4 style='color: green'>Send Failed!</h4>";
            }

        }
        elseif (isset($_POST['deleteBtn'])){
           $idDelete=$_POST['deleteBtn'];
           $query="DELETE FROM message where id=?";
           $stmt2=$conn->prepare($query);
           $stmt2->bind_param("s",$idDelete);
            if($stmt2->execute()){
                $messUpdate="<h4 style='color: green'>Delete Message Success!</h4>";
            }
            else{
                $messUpdate="<h4 style='color: red'>Delete Message Failed!</h4>";
            }
        }
        elseif (isset($_POST['updateBtn'])){
            $newContent=$_POST['newContent'];
            $idUpdate=$_POST['updateBtn'];
            $query="UPDATE message SET content=? where id=?";
            $stmt3=$conn->prepare($query);
            $stmt3->bind_param("ss",$newContent,$idUpdate);
            if($stmt3->execute()){
                $messUpdate="<h4 style='color: green'>Update Message Success!</h4>";
            }
            else{
                $messUpdate="<h4 style='color: red'>Update Message Failed!</h4>";
            }


        }
    }
    else{
        header("Location: list.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'?>
    <?php
        $query="SELECT * FROM message WHERE (recvId=? and sendId=?) or (recvId=? and sendId=?) order by date";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("ssss",$id,$_SESSION['id'],$_SESSION['id'],$id);
        $stmt->execute();
        $res1=$stmt->get_result();

        $rows=array();
        if(mysqli_num_rows($res1)>0){
            while($row=mysqli_fetch_object($res1)){
                $message=new Message($row->id,$row->sendId,$row->recvId,$row->content,$row->author,$row->date);
                $rows[]=$message;
            }
        }

    ?>
    <div class="container">
        <h3><center><b>Chat With <?=$res['username']?></b></center></h3>
        <div class="col-sm-12">
            <?php
                if(isset($messDelete)){
                    echo $messDelete;
                }
                if (isset($messUpdate)) {
                    echo $messUpdate;
                }
                foreach ($rows as $r){
                    echo "<br>";
                    echo "<form action='' method='post'>
                        <div class=\"form-group\">
                            <label>Author: {$r->getAuthor()}</label>
                            <textarea name='newContent' cols='30' rows='3' class='form-control'>{$r->getContent()}</textarea>
                        </div>";
                    if($r->getSendId()==$_SESSION['id']){
                        echo "
                            <button type='submit' class='btn btn-primary' name='deleteBtn' value='{$r->getId()}' onclick=\"return confirm('Delete Message ?')\">Delete</button>
                            <button type='submit' class='btn btn-primary' name='updateBtn' value='{$r->getId()}'>Update</button>
                        </form>";
                        }
                    ?>

                    <?php
                }
            ?>
            <br>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Send Message</label>
                    <textarea name="content" cols="30" rows="3" class="form-control" required></textarea>
                    <?php
                        if(isset($mess)){
                            echo $mess;
                        }
                    ?>
                </div>
                <button type="submit" class="btn btn-success" name="send" style="margin-bottom: 20px">Send</button>
            </form>
        </div>

    </div>
</body>
</html>