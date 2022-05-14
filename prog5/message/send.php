<?php
session_start();
require_once '../views/auth.php';
require_once '../config/connect.php';
require_once 'mess.php';
if(!empty($_POST['content']))
{
  $conn=Database::connection();
  $sendId=$_SESSION['id'];
  $recvId=$_POST['recvId'];
  $content=$_POST['content'];
  $author=$_POST['author'];
  $query="INSERT INTO message (sendId,recvId,content,author) values (?,?,?,?)";
  $stmt=$conn->prepare($query);
  $stmt->bind_param("ssss",$sendId,$recvId,$content,$author);
  $res=$stmt->execute();
  $stmt->close();
  header("Location: message.php?status=success");
}
else{
  header("Location: message.php?status=fail");
}