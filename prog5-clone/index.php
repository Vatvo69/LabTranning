<?php
session_start();
if($_SESSION['user']){
    header("Location: user/index.php");
}
else{
    header("Location: login.php");
}
