<?php
if(!isset($_SESSION)){
  session_start();
}
if(!isset($_SESSION['teacher'])||!isset($_SESSION['student'])){
  header("Location: login.php");
}