<?php
require_once 'config/connect.php';
class Permission{
  private $username;
  private $password;
  function __construct($user,$pass){
    $this->username=$user;
    $this->password=$pass;
  }

  function teacherCheck(){
    $ok=0;
    $conn=Database::connection();
    $user=$this->username;
    $pass=$this->password;
    $query="SELECT * FROM users where username=? AND password=? AND role=1";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ss",$user,$pass);

    $stmt->execute();
    if($stmt->fetch()==1){
      $ok=1;
    }
    return $ok;
  }

  function studentCheck(){
    $ok=0;
    $conn=Database::connection();
    $user=$this->username;
    $pass=$this->password;
    $query="SELECT * FROM users where username=? AND password=? AND role=0";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ss",$user,$pass);
    $stmt->execute();
    if($stmt->fetch()==1){
      $ok=1;
    }
    return $ok;
  }
  function getId(){
    $conn=Database::connection();
    $user=$this->username;
    $pass=$this->password;
    $query="SELECT id FROM users where username=? AND password=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ss",$user,$pass);
    $stmt->execute();
    $row=$stmt->get_result()->fetch_assoc();
    return $row["id"];
  }
}