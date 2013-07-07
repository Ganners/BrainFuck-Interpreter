<?php

namespace BrainFuck\Token;

use BrainFuck\Token\Token;
use BrainFuck\BrainFuck_Exception;

class Mock_Token extends Token {

	/**
	 * To be implemented by child classes
	 * 
	 * @param array $tape         - Our tape (array of 30000 containing ints)
	 * @param int   $ptr          - Our current position on the tape
	 * @param array $tokens       - Our array of tokens
	 * @param int   $tokenPointer - Our current position on the tokens
	 */
	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {
		echo 'ABC';
	}

}