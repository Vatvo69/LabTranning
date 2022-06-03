<?php
  require_once 'connect.php';

  class Permission{
    private $username;
    private $password;
    function __construct($username,$password){
      $this->username=$username;
      $this->password=$password;
    }
    function teacherCheck(){
      $ok=0;
      $conn=Database::connection();
      $username=$this->username;
      $password=$this->password;
      $query="SELECT * FROM users where username=? and password=? and role=1";
      $stmt=$conn->prepare($query);
      $stmt->bind_param("ss",$username,$password);
      $stmt->execute();
      if($stmt->fetch()==1){
        $ok=1;
      }
      return $ok;
    }
    function studentCheck(){
      $ok=0;
        $conn=Database::connection();
      $username=$this->username;
      $password=$this->password;
      $query="SELECT * FROM users where username=? and password=? and role=0";
      $stmt=$conn->prepare($query);
      $stmt->bind_param("ss",$username,$password);
      $stmt->execute();
      if($stmt->fetch()==1){
        $ok=1;
      }
      return $ok;
    }
    public function getId(){
        $conn=Database::connection();
      $username=$this->username;
      $password=$this->password;
      $query="SELECT * FROM users where username=? and password=?";
      $stmt=$conn->prepare($query);
      $stmt->bind_param("ss",$username,$password);
      $stmt->execute();
      $row=$stmt->get_result()->fetch_assoc();
      return $row["id"]; 
    }
  }
?>