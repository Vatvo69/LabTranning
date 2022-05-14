<?php
class Database{
  public static function connection(){
    $conn=new mysqli("localhost:3308","root","0000","db_user");
    if($conn->connect_errno){
      die("Khong the ket noi toi database");
      exit(0);
    }
    return $conn;
  }
}