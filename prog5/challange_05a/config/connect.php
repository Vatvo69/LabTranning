<?php
class Database{
  public static function connection(){
    $conn=new mysqli("localhost:3308","root","0000","challenge5a_vinhld");
    if($conn->connect_errno){
      die("Khong the ket noi toi database");
      exit(0);
    }
    return $conn;
  }
}