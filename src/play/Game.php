<?php
//Alexander and Nathanael Perez
//require_once 'Board.php';
require_once 'RandomStrategy.php';
require_once 'SmartStrategy.php';

class Game{
    
    public $board;
    public $strategy;
    public $x;
    public $y;
    public $winRow = array();
    
    //constructor for the board
    function __construct($board){
        $this->board = $board;
        $this->strategy = $this->board->strategy;
    }
    
    //gets the board according to the pid
    function getBoard($pid){
        return $this->board;
    }
    
    //gets computer move according to strategy type
    function makeMove(){
        if ($this->board->strategy == 'Smart'){
            $smart = new SmartStrategy($this->board);
            return $smart->pickSmart();
        }
        if($this->board->strategy == 'Random'){
            $random = new RandomStrategy($this->board);
            return $random->pickPlace();
        }
    }
    
    //checks if move was a win
    function isWin(){
        
        if($this->checkHorizontal() == true){
            return true;
        }
        
        
        if($this->checkVertical() == true){
            return true;
        }
        
        
        if($this->checkLeftDiagonal() == true){
            return true;
        }
        
        
        if($this->checkRightDiagonal() == true){
            return true;
        }
        
        return false;
        
    }
    
    //checks if move was a draw
    function isDraw(){
        
        $count = 0;
        for($i = 0; $i < $this->board->size; $i++){
            for($j = 0; $j < $this->board->size; $j++){
                if($this->board->coordinate[$i][$j] === 0){
                    $count = $count + 1;
                }
            }
        }
        
        if($count == 0){
            return true;
        }
        if($count > 0){
            return false;
        }
    }
    
    //checks horizontal
    function checkHorizontal(){
        
        for($i = 0; $i < $this->board->size; $i++){
            for($j = 0; $j <= ($this->board->size) - 5; $j++){
                $isWin = true;
                for($k = 0; $k < 5; $k++){
                    if(!($this->board->coordinate[$i][$j+$k]!=0 && $this->board->coordinate[$i][$j+$k] == $this->board->coordinate[$i][$j])){
                        $isWin = false;
                        break;
                    }   
                }
                if($isWin){
                    for($k = 0; $k < 5; $k++){
                        array_push($this->winRow, $i, $j+$k);
                    }
                    return true;
                }
            }
        }
        return false;
    }
    
    //checks vertical
    function checkVertical(){
        for($i = 0; $i <= ($this->board->size)-5; $i++){
            for($j = 0; $j < $this->board->size; $j++){
                $isWin = true;
                for($k = 0; $k < 5; $k++){
                    if(!($this->board->coordinate[$i+$k][$j]!=null && $this->board->coordinate[$i+$k][$j] === $this->board->coordinate[$i][$j])){
                        $isWin = false;
                        break;
                    }
                }
                if($isWin){
                    for($k = 0; $k < 5; $k++){
                        array_push($this->winRow, $i + $k, $j);
                    }
                    return true;
                }
            }
            
        }
        
        return false;
    }
    
    //checks left leaning diagonal
    function checkLeftDiagonal(){
        for($i = 0; $i <= ($this->board->size)-5; $i++){
            for($j = 0; $j <= ($this->board->size)-5; $j++){
                $isWin = true;
                for($k = 0; $k < 5; $k++){
                    if(!($this->board->coordinate[$i+$k][$j+$k]!=null && $this->board->coordinate[$i+$k][$j+$k] === $this->board->coordinate[$i][$j])){
                        $isWin = false;
                        break;
                    }
                }
                if($isWin){
                    for($k = 0; $k < 5; $k++){
                        array_push($this->winRow, $i + $k, $j + $k);
                    }
                    return true;
                }
            }
        }
        return false;
    }
    
    //checks right leaning diagonal
    function checkRightDiagonal(){
        
        for($i = 4; $i < $this->board->size; $i++){
            for($j = 0; $j <= ($this->board->size) - 5; $j++){
                $isWin = true;
                for($k = 0; $k < 5; $k++){
                    if(!($this->board->coordinate[$i-$k][$j+$k]!=null && $this->board->coordinate[$i-$k][$j+$k] === $this->board->coordinate[$i][$j])){
                        $isWin = false;
                        break;
                    }
                }
                if($isWin){
                    for($k = 0; $k < 5; $k++){
                        array_push($this->winRow, $i-$k, $j+$k);
                    }
                    return true;
                }
            }  
        }
        return false;
    }
}
