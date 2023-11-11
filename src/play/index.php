<?php
//Aleander Watson and Nathanael Perez

//Called require files
require_once 'Move.php';
require_once 'Board.php';
require_once 'Game.php';

//Defined url variables and path for readability
define('PID', 'pid');
define('STRATEGY', 'strategy');
define('X', 'x');
define('Y', 'y');
define('DATA', '../data/');

//checks if pid is specified
if(!array_key_exists(PID, $_GET)){
    echo json_encode(array('response'=>false,'reason'=>'Pid not specified'));
    exit;
}

//scans data path for files
$files = scandir(DATA);
$pid = $_GET[PID];

//tests to see if game was made
if(!in_array($pid.'.txt', $files)){
    echo json_encode(array('response'=>false,'reason'=>'Unknown pid'));
    exit;
}

//Checks to see if both x and y are present
if(!array_key_exists(X, $_GET) || !array_key_exists(Y, $_GET)){
    echo json_encode(array('response'=>false,'reason'=>'Move not well formed'));
    exit;
}

//checks to see if both x and y are present
if(count($_GET)==1){
    echo json_encode(array('response'=>false,'reason'=>'Move not specified'));
    exit;
}

//sees if x is in range
if($_GET[X] < 0 || $_GET[X] > 14){
    echo json_encode(array('response'=>false,'reason'=>'Invalid x coordinate'));
    exit;
}

//checks to see if y is in range
if($_GET[Y] < 0 || $_GET[Y] > 14){
    echo json_encode(array('response'=>false,'reason'=>'Invalid y coordinate'));
    exit;
}

//instantiates the board
$board = Board::getBoard($_GET[PID]);
//instantiates a gamestate
$game = new Game($board);
//inputs the playermove
$board->playerMove($_GET[X], $_GET[Y]);
//tells system to make a move
$coordinate = $game->makeMove();
//$board->coordinate[$coordinate[0]][$coordinate[1]] = 2;
//saves board state
$board->toFile();
//creates player and computer moves
$ack_move = new Move($_GET[X], $_GET[Y], $game->isWin(), $game->isDraw(), []);
$move = new Move($coordinate[0], $coordinate[1], $game->isWin(), $game->isDraw(), []);
//echos appropriate json
echo json_encode(array('response'=>true, 'ack_move'=>$ack_move, 'move'=>$move));