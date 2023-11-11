<?php
//Alexander Watson and Nathanael Perez
//Abstract move strategy
abstract class MoveStrategy {
    var $board;
    
    function __construct(Board $board = null) {
        $this->board = $board;
    }
    
    abstract function pickPlace();
    
    function toJson() {
        return array("name" => get_class($this));
    }
    
    static function fromJson() {
        return new static();  
    }
}