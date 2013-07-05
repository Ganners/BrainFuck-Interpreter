<?php

/**
 * A Brainfuck Interpreter!
 * 
 * Based only on reading the rules of each character
 * in BrainFuck this is my attempt to build it without
 * any resources.
 * 
 * @author Mark Gannaway <mark@ganners.co.uk>
 */

namespace BrainFuck;

use BrainFuck\String_Tokenizer;
use BrainFuck\Compiler;

class BrainFuck {

	/**
	 * Our start file
	 */
	protected $_codeInput;

	/**
	 * Provides the start file to be compiled
	 * 
	 * @param string $input     - The text input or file name of start file
	 * @param string $inputFile - TRUE if file input FALSE if direct input
	 */
	public function __construct($input, $inputFile) {

	}

	/**
	 * Will run the tokenizer and execute the code
	 * 
	 * @return bool
	 */
	public function execute() {

	}

	/**
	 * Will read a file and return it's contents
	 * 
	 * @param string $file
	 * 
	 * @return string $contents
	 * 
	 * @throws \Exception if file doesn't exist
	 */
	protected function _readFile($file) {

	}

	/**
	 * Will tokenize the input to an array of magic
	 * 
	 * @param string $input - The code to be tokenized
	 */
	protected function _tokenizeInput($input) {

	}

	/**
	 * Will run our tokens through the compiler
	 * 
	 * Output will be echo'd directly
	 */
	protected function _compileTokens($tokens) {

	}

}