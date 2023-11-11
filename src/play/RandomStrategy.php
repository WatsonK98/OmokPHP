<?php
//Alexander Watson and Nathanael Perez
//Random Strategy
require_once 'MoveStrategy.php';

class RandomStrategy extends MoveStrategy{
    
    function pickPlace(){
        $freeSpaces = $this->pickRandom();
        return $freeSpaces;
    }
    //uses boolean and while loop to look for an empty spot
    function pickRandom(){
        $takenTile = true;
        while($takenTile){
            $x = rand(0,14);
            $y = rand(0,14);
            $coordinate[0] = $x;
            $coordinate[1] = $y;
            if($this->board->isEmpty($x, $y) == true){
                $takenTile = false;
            }
        }
        return $coordinate;
    }
}