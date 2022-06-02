<?php
require_once '../config/connect.php';
class Mess{
    private $id;
    private $sendId;
    private $recvId;
    private $content;
    private $author;

    public function __construct($id,$sendId,$recvId,$content,$author){
        $this->id=$id;
        $this->sendId=$sendId;
        $this->recvId=$recvId;
        $this->content=$content;
        $this->author=$author;
    }
    public function getId(){
        return $this->id;
    }
    public function getSendId(){
        return $this->sendId;
    }
    public function getRecvId(){
        return $this->recvId;
    }
    public function getContent(){
        return $this->content;
    }
    public function getAuthor(){
        return $this->author;
    }
}