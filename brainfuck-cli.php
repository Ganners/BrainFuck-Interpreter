<?php 
//Require our autoloader
require_once('src/autoload.php');

//Create a new BrainFuck instance with our input
$Brain_Fuck = new BrainFuck\BrainFuck($argv[1], FALSE);

$status = 'success';
$output = '';

//Try and launch, record failures and store output in buffer
try {
 ob_start();
  $Brain_Fuck->execute();
  $output = ob_get_contents();
 ob_end_clean();
} catch (Exception $e) {
 $output = $e->getMessage();
 $status = 'failure';
}

echo $output;