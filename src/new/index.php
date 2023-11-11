<?php
//Alexander Watson and Nathanael Perez
require_once '../play/Board.php';

define('STRATEGY','strategy');

//Looks to see if strategy value is present
if(!array_key_exists(STRATEGY, $_GET)){
    echo json_encode(array('response'=>false,'reason'=>'Strategy not specified'));
    exit;
}

$strategy = $_GET[STRATEGY];

//Checks to see if strategy given matches a valid strategy
if(!($strategy === 'Smart' || $strategy === 'Random')){
    echo json_encode(array('response'=>false,'reason'=>'Unknown strategy'));
    exit;
}

//creates a new board
$board = new Board(15, $strategy);
//saves board
$board->toFile();
//echos a true response
echo json_encode(array('response'=>true,'pid'=>$board->pid));
