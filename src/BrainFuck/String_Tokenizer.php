<?php

namespace BrainFuck;

use BrainFuck\Token\Token;
use BrainFuck\BrainFuck_Exception;

class String_Tokenizer {

	//The name of our abstract class which all tokens
	//inherit from
	const TOKEN_ABSTRACT = 'BrainFuck\Token\Token';

	protected $_string;

	protected $currentLine      = 0,
			  $currentColumn    = 0,
			  $_availableTokens = array();

	/**
	 * Takes the string input and runs the
	 * tokenizer method to run the magic
	 * 
	 * @param string $string - Our code input
	 * @param array  $tokens - Our array of tokens, optional. If not
	 *                         passed then they will be grabbed
	 *                         automatically.
	 */
	public function __construct($string, $tokens = NULL) {
		$this->_string          = $string;

		if(!$tokens)
			$this->_availableTokens = $this->_fetchTokens();
		else
			$this->_availableTokens = $tokens;
	}

	/**
	 * Executes the processes required to tokenize
	 * a string
	 * 
	 * @return array - Array of tokens
	 * 
	 * @throws BrainFuck_Exception if a token is not found
	 */
	public function tokenize() {

		$tokens = array();

		//We want to ignore all whitespace
		$whiteSpaceChars = array(" ", "\r", "\n", "\t");

		foreach(str_split($this->_string) as $column => $char) {

			if(in_array($char, $whiteSpaceChars))
				continue;

			$tokenClassName = $this->_fetchMatchingToken($char);

			if(!$tokenClassName)
				throw new BrainFuck_Exception("Token not found for {$char}");

			$tokens[] = new $tokenClassName(0, $column);
			
		}

		$this->_tokens = $tokens;
		return $tokens;

	}

	/**
	 * Fetches the matching token for a given character
	 * 
	 * @param char
	 * 
	 * @return Token|bool
	 */
	protected function _fetchMatchingToken($char) {
		foreach($this->_availableTokens as $tokenClass => $token) {
			if(in_array($char, $token))
				return $tokenClass;
		}

		return FALSE;
	}

	/**
	 * Fetches all of the possible tokens
	 * 
	 * Tokens are found by looking up those which are
	 * declared and which inherit from the Token class.
	 * 
	 * @return array
	 */
	protected function _fetchTokens() {
		$availableTokens = array();

		//Load the file so classes are declared
		require_once('Token/Token.php');

		foreach(get_declared_classes() as $tokenClass) {
			if( in_array(self::TOKEN_ABSTRACT, class_parents($tokenClass) ) ) {
				if($tokenClass::$identifier) {
					$availableTokens[$tokenClass] = $tokenClass::$identifier;
				}
			}
		}

		return $availableTokens;
	}

}