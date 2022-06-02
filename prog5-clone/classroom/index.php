<?php
    require_once '../config/auth.php';
    require_once 'classroom.php';
?>
<?php
    $conn=Database::connection();
    if(isset($_POST['deleteBtn'])){
        $id=$_POST['deleteBtn'];
        $query="DELETE from class where id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("s",$id);
        $res=$stmt->execute();
        if($res){
            $mess = "<h4 style='color: green;'>Delete Exercise Success!</h4>";
        }
        else{
            $mess = "<h4 style='color: green;'>Delete Exercise Failed!</h4>";
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
    <title>List Exercise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <?php if ($_SESSION['teacher'])
        echo '<div class="row">
    <div class="col-md-2">
      <form action="add.php">
        <button class="btn btn-secondary" type="submit">Add Exercise</button>
      </form>
    </div>
  </div>'
    ?>
    <h3><center><b>List Exercise</b></center></h3>
    <div class="row" style="margin-top: 20px">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listExercise=ClassRoom::getAll();
                            foreach ($listExercise as $e){
                                echo "<tr>";
                                echo "<td>{$e->getTitle()}</td>";
                                echo "<td>{$e->getDate()}</td>";
                                echo "<td>";
                                echo "<a href='detail.php?id={$e->getId()}' class='btn btn-primary' style='float: right;margin-left: 8px;'>Detail</a>";
                                if($_SESSION['teacher']){
                                    echo "<form action='#' method='post'><button type='submit' class='btn btn-primary' name='deleteBtn' value='{$e->getId()}' style='float: right;margin-right: 8px;' onclick=\"return confirm('Delete {$e->getTitle()}')\">Delete</button></form>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php if(isset($mess)){
                echo $mess;
            } ?>
        </div>

    </div>
</div>
</body>
</html>