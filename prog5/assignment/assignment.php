<?php 
  class Assignment{
    private $id;
    private $title;
    private $date;
    private $idStudent;
    private $idAssignment;
    private $studentName;
    public function __construct($id,$title,$date,$idStudent,$idAssignment,$studentName){
      $this->id=$id;
      $this->title=$title;
      $this->date=$date;
      $this->idStudent=$idStudent;
      $this->idAssignment=$idAssignment;
      $this->studentName=$studentName;
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
    public function getIdStudent(){
      return $this->idStudent;
    }
    public function getIdAssignment(){
      return $this->idAssignment;
    }
    public function getStudentName(){
      return $this->studentName;
    }
  }
?>