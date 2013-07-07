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
use BrainFuck\BrainFuck_Exception;

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

		if($inputFile === TRUE) {
			//If it's a file, we read it into the codeInput
			$this->_codeInput = $this->_readFile($input);
		} else if ($inputFile === FALSE) {
			//If it's not a file, it's direct input
			$this->_codeInput = $input;
		} else {
			//If it's neither TRUE nor FALSE
			throw new BrainFuck_Exception('inputFile must be either TRUE or FALSE');
		}

	}

	/**
	 * Will run the tokenizer and execute the code
	 * 
	 * @return bool
	 */
	public function execute() {
		$this->_compileTokens(
			$this->_tokenizeInput( $this->_codeInput ) );
	}

	/**
	 * Will read a file and return it's contents
	 * 
	 * @param string $file
	 * 
	 * @return string $contents
	 * 
	 * @throws BrainFuck_Exception if file doesn't exist
	 */
	protected function _readFile($file) {

		if(!file_exists($file))
			throw new BrainFuck_Exception('File does not exist: ' . $file);

		$handle   = fopen($file, 'r');
		$contents = fread($handle, filesize($file));
		fclose($handle);

		return $contents;
	}

	/**
	 * Will tokenize the input to an array of magic
	 * 
	 * @param string $input - The code to be tokenized
	 */
	protected function _tokenizeInput($input) {

		//Construct our tokenizer
		$String_Tokenizer = new String_Tokenizer( $input );
		return $String_Tokenizer->tokenize();

	}

	/**
	 * Will run our tokens through the compiler
	 * 
	 * Output will be echo'd directly
	 */
	protected function _compileTokens($tokens) {

		$Compiler = new Compiler($tokens);
		$Compiler->compile();

	}

}