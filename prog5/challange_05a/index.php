<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: user/index.php");
}
else{
    header("Location: login.php");
}
