<?php

use BrainFuck\String_Tokenizer;
use BrainFuck\Token\Mock_Token;

require_once(__DIR__ . '/../Mocks/Mock_Token.php');

class String_TokenizerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		
		// Our fixture for tokens
		$this->Tokens = array(
			'BrainFuck\Token\Mock_Token' => array('X')
			);

	}

	public function testTokenize() {

		// Test that a string of white space returns an empty array of tokens
		$String_Tokenizer_WS = new String_Tokenizer("\r\n\t ", $this->Tokens);
        $this->assertCount(
        	0, $String_Tokenizer_WS->tokenize());
		
		// Test that with 3 valid tokens in the string, an array of 3 is returned
		$String_Tokenizer_XXX = new String_Tokenizer('XXX', $this->Tokens);
        $this->assertCount(
        	3, $String_Tokenizer_XXX->tokenize());

	}

    /**
     * @expectedException BrainFuck\BrainFuck_Exception
     */
	public function testTokenizeException() {

		//Test that invalid token characters throw an exception
		$String_Tokenizer_OO = new String_Tokenizer('OO', $this->Tokens);
		$String_Tokenizer_OO->tokenize();

	}

}