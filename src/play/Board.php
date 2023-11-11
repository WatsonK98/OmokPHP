<?php
//Alexander Watson and Nathanael Perez
class Board{
    
    public $size;
    public $strategy;
    public $pid;
    public $coordinate;
    
    function __construct($size=15, $strategy=""){
        
        $this->size = $size;
        $this->strategy = $strategy;
        $this->coordinate = array_fill(0,$size,array_fill(0,$size,0));
        $this->pid = uniqid();
        
    }
    //formats board state to json
    function toJson(){
        return json_encode($this);
    }
    //gets board state from file
    static function getBoard($pid){
        
        $path = "../data/".$pid.".txt";
        $file = fopen($path, "r") or die("File not found");
        $json = fread($file, filesize($path));
        fclose($file);
        
        return self::fromJson($json);
    }
    //creates board state from json
    static function fromJson($json){
        
        $obj = json_decode($json);
        $board = new Board();
        $board->size = $obj->size;
        $board->coordinate = $obj->coordinate;
        $board->pid = $obj->pid;
        $board->strategy = $obj->strategy;
        
        return $board;
    }
    //saves board state to file
    function toFile(){
        $file = fopen("../data/".$this->pid.".txt", "w");
        fwrite($file, $this->toJson());
        fclose($file);
    }
    //checks if space is empty
    function isEmpty($x, $y){
        $coordinate = $this->coordinate;
        if($coordinate[$x][$y] == 0){
            return true;
        } else {
            return false;
        }
    }
    //places player stone
    function playerMove($xp, $yp){
        if($this->isEmpty($xp, $yp) != false){
            $this->coordinate[$xp][$yp] = 1;
            $this->toFile();
        }
        else{
            echo json_encode(array('response'=>false,'reason'=>'Stone already placed'));
            exit;
        }
    }
    //places computer stone
    function computerMove($move){
        $this->coordinate[$move[0]][$move[1]] = 2;
    }
}