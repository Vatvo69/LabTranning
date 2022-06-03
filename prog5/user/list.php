<?php
include '../config/auth.php';
require_once 'user.php';
if (isset($_POST['deleteBtn'])) {
    $conn = Database::connection();
    $id = $_POST['deleteBtn'];
    $query = "DELETE from users where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $res = $stmt->execute();
    if ($res) {
        unlink('avatar/'.$_POST['file']);
        $mess = "<h4 style='color: green;'>Delete User Success!</h4>";
    } else {
        $mess = "<h4 style='color: red;'>Delete User Failed!</h4>";
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
    <title>List User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include 'header.php' ?>
<div class="container">
    <?php if ($_SESSION['teacher'])
        echo '<div class="row">
            <div class="col-md-2">
                <form action="add.php">
                    <button type="submit" class="btn btn-secondary">Add User</button>
                </form>
            </div>
        </div>';
    ?>
    <h3>
        <center><b>List User</b></center>
    </h3>
    <div class="row" style="margin-top: 20px">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($mess)) {
                        echo $mess;
                    }
                    $listUser = User::getAll();
                    foreach ($listUser as $user) {
                        echo "<tr>";
                        echo "<td>{$user->getUsername()}</td>";
                        echo "<td>{$user->getFullName()}</td>";
                        echo "<td>{$user->getEmail()}</td>";
                        echo "<td>{$user->getPhone()}</td>";
                        echo "<td>{$user->getRole()}</td>";
                        echo "<td>";
                        echo "<a href='chat.php?id={$user->getId()}' class='btn btn-primary' style='float: right;margin-right: 8px'>Chat</a>";
                        echo "<a href='detail.php?id={$user->getId()}' class='btn btn-primary' style='float: right;margin-right: 8px'>Detail</a>";
                        ?>
                        <?php if ($_SESSION['teacher']) {
                            echo "<form action='profile.php' style='float: right;margin-right: 8px;' method='post'>
                                             <button type='submit' class='btn btn-primary' value='{$user->getUsername()}' name='editBtn'>Edit</button>
                                           </form>";
                            echo "<form action='' style='float: right;margin-right: 8px;' method='post'><input type='hidden' name='file' value='{$user->getAvatar()}'><button type='submit' class='btn btn-primary' value='{$user->getId()}' name='deleteBtn' onclick=\"return confirm('Delete User {$user->getUsername()}')\">Delete</button></form>";
                        } ?>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
</body>
>
</html>