<?php 
//Require our autoloader
require_once('src/autoload.php');

//Our default application is 'Hello world!'
$helloWorldSrc = '>+++++++++[<++++++++>-]<.>+++++++[<++++>-]<+.+++++++..+++.[-]>++++++++[<++++>-]
<.>+++++++++++[<++++++++>-]<-.--------.+++.------.--------.[-]>++++++++[<++++>-
]<+.[-]++++++++++.';

//Create a new BrainFuck instance with our input
$Brain_Fuck = new BrainFuck\BrainFuck(
 isset($_POST['input']) ? $_POST['input'] : $helloWorldSrc, FALSE);

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
?>
<!doctype HTML>
<html>
 <head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
  <title>BrainFuck Inline Interpreter</title>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
 </head>
 <body>

  <div class="container">
   <div class="row">

    <div class="span12">
     <h1>BrainFuck Inline Interpreter</h1>
     <hr />
    </div>

   </div>
   <div class="row">

    <!-- Input Box -->
    <div class="span6">
     <h3>Input</h3>
     <form method="post">
      <textarea name="input" id="input" rows="10" style="width: 100%;"><?php echo htmlentities(isset($_POST['input']) ? $_POST['input'] : $helloWorldSrc); ?></textarea>
      <button class="btn btn-large btn-primary">Submit</button>
     </form>
    </div>
    <!-- /Input Box -->

    <!-- Output Box -->
    <div class="span6">
     <h3>Output</h3>
     <?php if($status === 'success') { ?>
      <div class="text-success well">
       <?php echo nl2br($output); ?>
      </div>
     <?php } else { ?>
      <div class="text-error well">
       <?php echo nl2br($output); ?>
      </div>
     <?php } ?>
    </div>
    <!-- /Output Box -->

   </div>
  </div>

 </body>
</html>