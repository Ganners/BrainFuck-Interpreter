<?php

use BrainFuck\Compiler;
use BrainFuck\Token\Mock_Token;

require_once(__DIR__ . '/../Mocks/Mock_Token.php');

class CompilerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		
	}

	public function testConstruct() {

		$inputArray = array('one', 'two', 'three');

		// Test that our argument gets set as the
		// _tokens object variable
		$Compiler = new Compiler($inputArray , FALSE);
    	$this->assertEquals(
    		$this->readAttribute($Compiler, '_tokens'), $inputArray);

	}

	public function testCompile() {
			
		// Create a few mock token which echo output,
		// store them in buffer and check it matches
		$this->expectOutputString('ABCABC');

		// Put some mock tokens which print 'ABC' into array
		$tokens = array(
			new Mock_Token(0,0), 
			new Mock_Token(0,1));

		// Execute our compiler
		$Compiler = new Compiler($tokens);
		$Compiler->compile();

	}

}