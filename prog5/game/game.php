<?php 
  require_once '../config/connect.php';
  class Game{
    private $idTeacher;
    private $title;
    private $hint;
    private $fileName;
    private $date;
    public function __construct($id,$idTeacher,$title,$hint,$fileName,$date){
      $this->id=$id;
      $this->idTeacher=$idTeacher;
      $this->title=$title;
      $this->hint=$hint;
      $this->fileName=$fileName;
      $this->date=$date;
    }
    public function getId(){
      return $this->id;
    }
    public function getIdTeacher(){
      return $this->idTeacher;
    }
    public function getTitle(){
      return $this->title;
    }
    public function getHint(){
      return $this->hint;
    }
    public function getFileName(){
      return $this->fileName;
    }
    public function getDate(){
      return $this->date;
    }
    public static function getAll(){
      $conn=Database::connection();
      $query="SELECT * from game";
      $res=mysqli_query($conn,$query);
      $rows=array();
      if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_object($res)){
          $game=new Game($row->id,$row->idTeacher,$row->title,$row->hint,$row->fileName,$row->date);
          $rows[]=$game;
        }
      }
      return $rows;
    }
  }

?>