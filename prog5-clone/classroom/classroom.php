<?php
    require_once '../config/connect.php';
    class ClassRoom{
        private $id;
        private $title;
        private $date;
        private $file;
        public function __construct($id,$title,$file,$date)
        {
            $this->id=$id;
            $this->title=$title;
            $this->file=$file;
            $this->date=$date;
        }

        public function getId(){
            return $this->id;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getDate(){
            return $this->date;
        }
        public function getFile(){
            return $this->file;
        }
        public static function getAll(){
            $conn=Database::connection();
            $query="SELECT * from class";
            $res=mysqli_query($conn,$query);
            $rows=array();
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_object($res)){
                    $class=new ClassRoom($row->id,$row->title,$row->file,$row->date);
                    $rows[]=$class;
                }
            }
            return $rows;
        }
    }