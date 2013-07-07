<?php

use BrainFuck\BrainFuck;

class BrainFuckTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		
	}

	public function testConstruct() {

		// Test when we input some code with inputFile false
		// it sets the _codeInput object variable
		$BrainFuck_DirectInput = new BrainFuck('>+.', FALSE);
    	$this->assertEquals(
    		$this->readAttribute($BrainFuck_DirectInput, '_codeInput'), '>+.');
		
		// Test when we input a file, the contents of that file
		// is sent to the _codeInput object variable
		$BrainFuck_DirectInput = new BrainFuck(__DIR__ . '/../Test_Files/hello_world.bf', TRUE);
    	$this->assertEquals(
    		$this->readAttribute($BrainFuck_DirectInput, '_codeInput'),
    		'++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.');
		
	}

    /**
     * @expectedException BrainFuck\BrainFuck_Exception
     */
	public function testConstructTypeException() {
		
		// Test when $inputFile is not bool an \Exception is thrown
		$BrainFuck_DirectInput = new BrainFuck('>+.', 'CAT');
		
	}

	public function testReadFile() {

		// Tests that a file can be read - Use reflection to make protected
		// method available
		$BrainFuck = new BrainFuck('>+.', FALSE);
        $method = new ReflectionMethod(
          $BrainFuck, '_readFile'
        );

        $method->setAccessible(TRUE);

        //Test input of (int) 100
        $this->assertEquals( 
        	$method->invokeArgs( 
        		$BrainFuck, array(__DIR__ . '/../Test_Files/hello_world.bf')), 
        		'++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.');

	}

}