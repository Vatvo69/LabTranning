<?php
    session_start();
    var_dump(($_SESSION));
    if(!$_SESSION['teacher']){
        header("Location: list.php");
    }
?>