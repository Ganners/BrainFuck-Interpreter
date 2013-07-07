<?php

require_once('src/autoload.php');

$helloWorld = ">+++++++++[<++++++++>-]<.>+++++++[<++++>-]<+.+++++++..+++.[-]>++++++++[<++++>-]
<.>+++++++++++[<++++++++>-]<-.--------.+++.------.--------.[-]>++++++++[<++++>-
]<+.[-]++++++++++.";

$Brain_Fuck = new BrainFuck\BrainFuck($helloWorld, FALSE);
$Brain_Fuck->execute();