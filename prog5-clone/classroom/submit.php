<?php
require_once '../config/connect.php';
class Submit{
    private $id;
    private $title;
    private $idStudent;
    private $idExercise;
    private $studentName;
    private $file;
    private $date;
    public function __construct($id,$title,$idStudent,$idExercise,$studentName,$file,$date)
    {
        $this->id=$id;
        $this->title=$title;
        $this->idStudent=$idStudent;
        $this->idExercise=$idExercise;
        $this->studentName=$studentName;
        $this->file=$file;
        $this->date=$date;
    }
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getIdStudent(){
        return $this->idStudent;
    }
    public function getIdExercise(){
        return $this->idExercise;
    }
    public function getFile(){
        return $this->file;
    }
    public function getDate(){
        return $this->date;
    }
    public function getStudentName(){
        return $this->studentName;
    }
}