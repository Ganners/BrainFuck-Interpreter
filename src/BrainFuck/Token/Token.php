<?php

namespace BrainFuck\Token;

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

	}

	/**
	 * Returns the line
	 * 
	 * @return int
	 */
	public function getLine() {

	}

	/**
	 * Returns the column
	 * 
	 * @return int
	 */
	public function getColumn() {

	}

}

/**
 * > - Increment the pointer to point to the next cell to the right.
 */
class Increment_Pointer extends Token {

}

/**
 * < - Decrement the pointer to point to the next cell to the left.
 */
class Decrement_Pointer extends Token {

}

/**
 * + - Increment the byte pointed to by the pointer.
 */
class Increment_Byte_Pointed_To extends Token {

}

/**
 * - - Decrement the byte pointed to by the pointer.
 */
class Decrement_Byte_Pointed_To extends Token {

}

/**
 * [ - Jump forward to the command after the corresponding ] if the byte at the pointer is zero.
 */
class Jump_Forward extends Token {

}

/**
 * ] - Jump back to the command after the corresponding [ if the byte at the pointer is non-zero.
 */
class Jump_Backward extends Token {

}

/**
 * . - Output the value of the byte at the pointer.
 */
class Output_Value_At_Pointer extends Token {

}

/**
 * , - Accept one byte of input, storing its value in the byte at the pointer.
 */
class Accept_Input extends Token {

}