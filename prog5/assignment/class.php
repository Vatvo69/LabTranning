<?php 
  require_once '../config/connect.php';
  class Classfile{
    private $title;
    private $date;
    private $id;
    public function __construct($id,$title,$date){
      $this->id=$id;
      $this->title=$title;
      $this->date=$date;
    }
    public function getTitle(){
      return $this->title;
    }
    public function getDate(){
      return $this->date;
    }
    public function getId(){
      return $this->id;
    }
    public static function getAll(){
      $conn=Database::connection();
      $query="SELECT id,title,date from class";
      $res=mysqli_query($conn,$query);
      $rows=array();
      if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_object($res)){
          $class=new Classfile($row->id,$row->title,$row->date);
          $rows[]=$class;
        }
      }
      return $rows;
    }
  }
?>