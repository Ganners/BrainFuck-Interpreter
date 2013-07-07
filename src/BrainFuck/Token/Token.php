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

	/**
	 * Checks if the pointer is in bounds, throws
	 * exception if true
	 * 
	 * @param array $tape
	 * @param int   $ptr
	 * 
	 * @throws BrainFuck_Exception if out of bounds
	 */
	public function tapeBoundsCheck(&$ptr, $tapeLength = 30000) {
		if($ptr < 0 || $ptr > $tapeLength)
			throw new BrainFuck_Exception("Pointer is out of bounds");
	}

}

/**
 * > - Increment the pointer to point to the next cell to the right.
 */
class Increment_Pointer extends Token {
	static $identifier = array('>');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		++$ptr;
	}
}

/**
 * < - Decrement the pointer to point to the next cell to the left.
 */
class Decrement_Pointer extends Token {
	static $identifier = array('<');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		--$ptr;
	}
}

/**
 * + - Increment the byte pointed to by the pointer.
 */
class Increment_Byte_Pointed_To extends Token {
	static $identifier = array('+');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		++$tape[$ptr];
	}
}

/**
 * - - Decrement the byte pointed to by the pointer.
 */
class Decrement_Byte_Pointed_To extends Token {
	static $identifier = array('-');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		--$tape[$ptr];
	}
}

/**
 * [ - Jump forward to the command after the corresponding ] if the byte at the pointer is zero.
 */
class Jump_Forward extends Token {
	static $identifier = array('[');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		if( $tape[$ptr] === 0 ) {

			$loop = 1;

			//We do this loop so that we can deal with nested loops
			//and exit only when we find our match.
			while($loop > 0) {
				++$tokenPointer;
				if($tokens[$tokenPointer] instanceof Jump_Backward) {
					--$loop;
				} else if ($tokens[$tokenPointer] instanceof Jump_Forward) {
					++$loop;
				}
			}

		} else {
			return 0;
		}
	}
}

/**
 * ] - Jump back to the command after the corresponding [ if the byte at the pointer is non-zero.
 */
class Jump_Backward extends Token {
	static $identifier = array(']');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		if( $tape[$ptr] !== 0 ) {

			$loop = 1;

			//We do this loop so that we can deal with nested loops
			//and exit only when we find our match.
			while($loop > 0) {
				--$tokenPointer;
				if($tokens[$tokenPointer] instanceof Jump_Backward) {
					++$loop;
				} else if ($tokens[$tokenPointer] instanceof Jump_Forward) {
					--$loop;
				}
			}

		} else {
			return 0;
		}
	}
}

/**
 * . - Output the value of the byte at the pointer.
 */
class Output_Value_At_Pointer extends Token {
	static $identifier = array('.');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer) {

		$this->tapeBoundsCheck($ptr);

		echo chr($tape[$ptr]);
	}
}

/**
 * , - Accept one byte of input, storing its value in the byte at the pointer.
 */
class Accept_Input extends Token {
	static $identifier = array(',');

	public function runToken(&$tape, &$ptr, &$tokens, &$tokenPointer, $stream = NULL) {

		$this->tapeBoundsCheck($ptr);

		if(!$stream)
			$stream = STDIN;

		while(true) {
			$line = trim(stream_get_line($stream, 1024, PHP_EOL));

			if($line) {
				$tape[$ptr] = ord($line);
				break;
			}
		}
		
	}
}