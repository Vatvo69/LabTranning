<?php
    require_once '../config/auth.php';
    require_once '../config/connect.php';
    require_once 'game.php';
    if(isset($_POST['delete'])){
        $conn=Database::connection();
        $id=$_POST['delete'];
        $query="DELETE FROM game where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $res=$stmt->execute();
        $file=$_POST['file'];
        $file_path='uploads/'.$file;
        if($res){
            if(file_exists($file_path))
            {
                unlink($file_path);
                $mess = "<h4 style='color: green;'>Delete Game Success!</h4>";
            }
        }
        else{
            $mess = "<h4 style='color: green;'>Delete Game Failed!</h4>";
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
    <title>List Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <?php include 'header.php'?>
    <div class="container">
        <?php if(isset($_SESSION['teacher'])){
            echo '<div class="row">
            <div class="col-md-2">
                <form action="add.php">
                    <button type="submit" class="btn btn-secondary">Add Game</button>
                </form>
            </div>
        </div>';
        } ?>
        <h3><center><b>List Game</b></center></h3>
        <?php if(isset($mess)){
            echo $mess;
        } ?>
        <div class="row" style="margin-top: 20px">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Hint</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    $listGame=Game::getAll();
                                    foreach ($listGame as $game){
                                        echo "<td>{$game->getTitle()}</td>";
                                        echo "<td>{$game->getHint()}</td>";
                                        echo "<td>{$game->getDate()}</td>";
                                        echo "<td>";
                                        echo "<a href=\"play.php?id={$game->getId()}\" class=\"btn btn-primary\" style=\"float: right;margin-right: 8px\">Play</a>";
                                        echo "<form action=\"\" method='post'><input type='hidden' name='file' value='{$game->getFile()}'><button type=\"submit\" class=\"btn btn-primary\" style=\"float: right;margin-right: 8px\" onclick='return confirm(\"Delete Game?\")' name='delete' value='{$game->getId()}'>Delete</button></form>";
                                        echo "</td>";
                                    }
                                ?>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>