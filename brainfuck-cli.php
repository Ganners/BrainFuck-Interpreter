<?php 
//Require our autoloader
require_once('src/autoload.php');

//Create a new BrainFuck instance with our input
$Brain_Fuck = new BrainFuck\BrainFuck($argv[1], FALSE);

//Try and launch, record failures and store output in buffer
try {
	$Brain_Fuck->execute();
} catch (Exception $e) {
	$output = $e->getMessage();
}