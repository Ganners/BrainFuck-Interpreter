<?php

use BrainFuck\Token\Token;
use BrainFuck\Token\Increment_Pointer;
use BrainFuck\Token\Decrement_Pointer;
use BrainFuck\Token\Increment_Byte_Pointed_To;
use BrainFuck\Token\Decrement_Byte_Pointed_To;
use BrainFuck\Token\Jump_Forward;
use BrainFuck\Token\Jump_Backward;
use BrainFuck\Token\Output_Value_At_Pointer;
use BrainFuck\Token\Accept_Input;

class TokenTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		
		$this->tape = array_fill(0, 30000, 0);

	}

	public function testIncrement_PointerRunToken() {

		$tape   = $this->tape;
		$ptr    = 0;
		$tokens = array(
			new Increment_Pointer(0,0),
			new Increment_Pointer(0,0));

		$tokenPointer = 0;

		// We expect that $ptr will have iterated by 1
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals(1, $ptr);

	}

	public function testDecrement_PointerRunToken() {

		$tape         = $this->tape;
		$ptr          = 2;
		$tokens       = array(
			new Decrement_Pointer(0,0),
			new Decrement_Pointer(0,0));

		$tokenPointer = 0;

		// We expect that $ptr will have decremented by 1
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals(1, $ptr);

	}

	public function testIncrement_Byte_Pointed_ToRunToken() {

		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Increment_Byte_Pointed_To(0,0),
			new Increment_Byte_Pointed_To(0,0));

		$tokenPointer = 0;

		// Check before we run that it is 0
		$this->assertEquals($tape[$ptr], 0);

		// We expect that $ptr will have byte added
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tape[$ptr], 1);

	}

	public function testDecrement_Byte_Pointed_ToRunToken() {

		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Decrement_Byte_Pointed_To(0,0),
			new Decrement_Byte_Pointed_To(0,0));

		$tokenPointer = 0;

		//Set our initial value to 5
		$tape[2] = 5;

		// Check before we run that it is 5
		$this->assertEquals($tape[$ptr], 5);

		// We expect that the byte at ptr 2 will decrement to 4
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tape[$ptr], 4);

	}

	public function testJump_ForwardRunToken() {

		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Jump_Forward(0,0),
			new Increment_Byte_Pointed_To(0, 1),
			new Increment_Byte_Pointed_To(0, 1),
			new Increment_Byte_Pointed_To(0, 1),
			new Jump_Backward(0,2));

		$tokenPointer = 0;

		// We expect that the token pointer will increment to 4
		// when byte at pointer is 0
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tokenPointer, 4);

		$tape[$ptr] = 1;

		// We expect that the token pointer will not change
		// when current pointer is not 0
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tokenPointer, 0);

	}

	public function testJump_BackwardRunToken() {

		//Reverse of forward test
		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Jump_Forward(0,0),
			new Increment_Byte_Pointed_To(0, 1),
			new Increment_Byte_Pointed_To(0, 1),
			new Increment_Byte_Pointed_To(0, 1),
			new Jump_Backward(0,2));

		$tokenPointer = 4;

		$tape[$ptr] = 0;

		// We expect that the token pointer will remain
		// when byte at pointer is 0
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tokenPointer, 4);

		$tape[$ptr] = 1;

		// We expect that the token pointer will decrement to
		// 'Jump_Forward' when byte is not 0
		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

		$this->assertEquals($tokenPointer, 0);

	}

	public function testOutput_Value_At_PointerRunToken() {

		// Expect an output string of A (Dec 65)
		$this->expectOutputString('A');

		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Output_Value_At_Pointer(0,0));

		$tokenPointer = 0;
		$tape[$ptr] = 65;

		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer);

	}

	public function testAccept_InputRunToken() {

		// Expect when we write A into STDIN, the
		// value at the current pointer will be 65
		$tape   = $this->tape;
		$ptr    = 2;
		$tokens = array(
			new Accept_Input(0,0));
		$tokenPointer = 0;

		// Create our mock stream using memory, we pass it
		// as an optional parameter, created for the purpose
		// of making it testable.
		$stdin = fopen('php://memory', 'w+');
			fwrite($stdin, 'A' . PHP_EOL);
			rewind($stdin);

		$tokens[$tokenPointer]
			->runToken($tape, $ptr, $tokens, $tokenPointer, $stdin);

		fclose($stdin);

		// Assert our A is read as 65
		$this->assertEquals(
			$tape[$ptr], 65);

	}

}