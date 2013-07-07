<?php

namespace BrainFuck\Token;

use BrainFuck\BrainFuck_Exception;

/**
 * Our base class for a Token, all
 * tokens should inherit from this.
 */
abstract class Token {

	protected $_line,
			  $_column;

	static $identifier;

	/**
	 * Sets up our token
	 * 
	 * @param int $line - The line the token was declared on
	 * @param int $column - The column the token was declared on
	 */
	public function __construct($line, $column) {
		$this->_line = $line;
		$this->_column = $column;
	}

	/**
	 * Returns the line
	 * 
	 * @return int
	 */
	public function getLine() {
		return $this->_line;
	}

	/**
	 * Returns the column
	 * 
	 * @return int
	 */
	public function getColumn() {
		return $this->_column;
	}

	/**
	 * To be implemented by child classes
	 * 
	 * @param array $tape         - Our tape (array of 30000 containing ints)
	 * @param int   $ptr          - Our current position on the tape
	 * @param array $tokens       - Our array of tokens
	 * @param int   $tokenPointer - Our current position on the tokens
	 */
	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

	}

}

/**
 * > - Increment the pointer to point to the next cell to the right.
 */
class Increment_Pointer extends Token {
	static $identifier = array('>');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {
		++$ptr;
	}
}

/**
 * < - Decrement the pointer to point to the next cell to the left.
 */
class Decrement_Pointer extends Token {
	static $identifier = array('<');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {
		--$ptr;
	}
}

/**
 * + - Increment the byte pointed to by the pointer.
 */
class Increment_Byte_Pointed_To extends Token {
	static $identifier = array('+');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {
		++$tape[$ptr];
	}
}

/**
 * - - Decrement the byte pointed to by the pointer.
 */
class Decrement_Byte_Pointed_To extends Token {
	static $identifier = array('-');

}

/**
 * [ - Jump forward to the command after the corresponding ] if the byte at the pointer is zero.
 */
class Jump_Forward extends Token {
	static $identifier = array('[');

}

/**
 * ] - Jump back to the command after the corresponding [ if the byte at the pointer is non-zero.
 */
class Jump_Backward extends Token {
	static $identifier = array(']');

}

/**
 * . - Output the value of the byte at the pointer.
 */
class Output_Value_At_Pointer extends Token {
	static $identifier = array('.');

}

/**
 * , - Accept one byte of input, storing its value in the byte at the pointer.
 */
class Accept_Input extends Token {
	static $identifier = array(',');

}