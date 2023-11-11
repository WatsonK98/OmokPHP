<?php

class Board{
    public $size;
    public $pid;
    
    function __construct($size, $strategy){
        $this->size=$size;
        $this->strategy=strategy;
        $this->pid=uniqid();
    }
}