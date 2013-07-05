<?php

namespace BrainFuck;

use BrainFuck\Token\Token;

class String_Tokenizer {

	//The name of our abstract class which all tokens
	//inherit from
	const TOKEN_ABSTRACT = 'BrainFuck\Token\Token';

	private $_string;

	private $currentLine   = 0,
			$currentColumn = 0,
			$tokens        = array();

	/**
	 * Takes the string input and runs the
	 * tokenizer method to run the magic
	 * 
	 * @param string $string - Our code input
	 */
	public function __construct($string) {

	}

	/**
	 * Executes the processes required to tokenize
	 * a string
	 * 
	 * @return array - Array of tokens
	 */
	public function tokenize() {

	}

	/**
	 * Fetches the matching token for a given character
	 * 
	 * @param char
	 * 
	 * @return Token|bool
	 */
	private function _fetchMatchingToken($char) {

	}

	/**
	 * Fetches all of the possible tokens
	 * 
	 * Tokens are found by looking up those which are
	 * declared and which inherit from the Token class.
	 * 
	 * @return array
	 */
	private function _fetchTokens() {

	}

}