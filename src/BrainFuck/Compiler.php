<?php

/**
 * Our compiler will execute our tokens
 */

namespace BrainFuck;

use BrainFuck\BrainFuck_Exception;

class Compiler {

	protected $_tokens;

	/**
	 * Constructor, sends the tokens to the compiler
	 * 
	 * @param array $tokens
	 */
	public function __construct(array $tokens) {
		$this->_tokens = $tokens;
	}

	/**
	 * Executes the tokens, runs the code magic style
	 */
	public function compile() {

		//Convention states for an array of length 30000
		$tape = array_fill(0, 30000, 0);
		$ptr = 0;

		for($tokenPointer = 0; $tokenPointer < count($this->_tokens); ++$tokenPointer) {

			//Pass all data on pointers and tokens to our token, they can handle it from here
			$this->_tokens[$tokenPointer]->runToken($tape, $ptr, $this->_tokens, $tokenPointer);

		}

	}

}