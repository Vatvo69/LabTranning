<?php
    require_once '../config/connect.php';
    class ClassRoom{
        private $id;
        private $title;
        private $date;
        public function __construct($id,$title,$date)
        {
            $this->id=$id;
            $this->title=$title;
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

        public static function getAll(){
            $conn=Database::connection();
            $query="SELECT * from class";
            $res=mysqli_query($conn,$query);
            $rows=array();
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_object($res)){
                    $class=new ClassRoom($row->id,$row->title,$row->date);
                    $rows[]=$class;
                }
            }
            return $rows;
        }
    }