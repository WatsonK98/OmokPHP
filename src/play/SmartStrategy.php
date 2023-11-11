<?php
//Alexander Watson and Nathanael Perez
require_once 'MoveStrategy.php';

class SmartStrategy extends MoveStrategy{
    function pickPlace(){
        $freespace = $this->pickSmart();
        return $freespace;
    }
    function pickSmart(){
        
        $arr1 = [-1, -1];
        $arr2 = [-1, -1];
        
        //Looks for Vertical Space with 4 stones
        for($i = 0; $i < $this->board->size; $i++){
            for($j = 0; $j <= $this->board->size - 4; $j++){
                $strategyFound = true;
                for($k = 0; $k < 4; $k++){
                    if($this->board->coordinate[$i][$j+$k] != null && $this->board->coordinate[$i][$j+$k] === $this->board->coordinate[$i][$j]){
                        continue;
                    } else {
                        $strategyFound = false;
                        break;
                    }
                }
                
                if($strategyFound){
                    if($j+4 != $this->board->size){
                        $arr1[0] = $i;
                        $arr1[1] = $j+4;
                    }
                    
                    if($j > 0){
                        $arr2[0] = $i;
                        $arr2[1] = $j-1;
                    }
                }
                
                if($arr1[0] != -1 && $arr1[1] != -1){
                    if($this->board->isEmpty($arr1[0], $arr1[1])){
                        return $arr1;
                    }
                }
                
                if($arr2[0] != -1 && $arr2[1] != -1){
                    if($this->board->isEmpty($arr2[0], $arr2[1])){
                        return $arr2;
                    }
                }
            }
        }
        
        //looks for horizontal space with 4 stones
        for($i = 0; $i <= $this->board->size - 4; $i++){
            for($j = 0; $j < $this->board->size; $j++){
                $strategyFound = true;
                for($k = 0; $k < 4; $k++){
                    if($this->board->coordinate[$i+$k][$j] != null && $this->board->coordinate[$i+$k][$j] === $this->board->coordinate[$i][$j]){
                        continue;
                    } else {
                        $strategyFound = false;
                        break;
                    }
                }
                
                if($strategyFound){
                    if($i+4 != $this->board->size){
                        $arr1[0] = $i+4;
                        $arr1[1] = $j;
                    }
                    
                    if($j > 0){
                        $arr2[0] = $i-1;
                        $arr2[1] = $j;
                    }
                }
                
                if($arr1[0] != -1 && $arr1[1] != -1){
                    if($this->board->isEmpty($arr1[0], $arr1[1])){
                        return $arr1;
                    }
                }
                
                if($arr2[0] != -1 && $arr2[1] != -1){
                    if($this->board->isEmpty($arr2[0], $arr2[1])){
                        return $arr2;
                    }
                }
                
                
            }
            
        }
        
        //looks for right leaning diagonal with 4 stones
        for($i = 0; $i <= $this->board->size-4; $i++){
            for($j = 0; $j <= $this->board->size-4; $j++){
                $strategyFound = true;
                for($k = 0; $k < 4; $k++){
                    if($this->board->coordinate[$i+$k][$j+$k] != null && $this->board->coordinate[$i+$k][$j+$k] === $this->board->coordinate[$i][$j]){
                        continue;
                    } else {
                        $strategyFound = false;
                        break;
                    }
                }
                
                if($strategyFound){
                    if($i+4 != $this->board->size && $j+4 != $this->board->size){
                        $arr1[0] = $i+4;
                        $arr1[1] = $j+4;
                    }
                    if($arr1[0] != -1 && $arr1[1] != -1){
                        if($this->board->isEmpty($arr1[0], $arr1[1])){
                            return $arr1;
                        }
                    }
                    if($i -1 != -1 || $j-1 != 1){
                        $arr2[0] = $i-1;
                        $arr2[1] = $j-1;
                    }
                    if($arr2[0] != -1 && $arr2[1] != -1){
                        if($this->board->isEmpty($arr2[0], $arr2[1])){
                            return $arr2;
                        }
                    }
                }
                
                
            }
            
        }
        
        //looks for left leaning diagonal with 4 stones
        for($i = 3; $i < $this->board->size; $i++){
            for($j = 0; $j <= $this->board->size-4; $j++){
                $strategyFound = true;
                for($k = 0; $k < 4; $k++){
                    if($this->board->coordinate[$i-$k][$j+$k] != null && $this->board->coordinate[$i-$k][$j+$k] === $this->board->coordinate[$i][$j]){
                        continue;
                    } else {
                        $strategyFound = false;
                        break;
                    }
                }
                
                if($strategyFound){
                    if($i - 4 != -1 && $j+4 != $this->board->size){
                        $arr1[0] = $i-4;
                        $arr1[1] = $j+4;
                    }
                    if($arr1[0] != -1 && $arr1[1] != -1){
                        if($this->board->isEmpty($arr1[0], $arr1[1])){
                            return $arr1;
                        }
                    }
                    if($i + 1 != $this->board->size && $j - 1 != 1){
                        $arr2[0] = $i+1;
                        $arr2[1] = $j-1;
                    }
                    if($arr2[0] != -1 && $arr2[1] != -1){
                        if($this->board->isEmpty($arr2[0], $arr2[1])){
                            return $arr2;
                        }
                    }
                }
                
            }
        }
        
        return $this->pickRandom();
    }
    //If it can't react with above, then performs a random placement
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