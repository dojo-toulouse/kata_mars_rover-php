<?php

require('Bot.php');
class BotTest extends PHPUnit_Framework_TestCase
{
	public function setUp() 
	{
		$this->bot = new Bot(0, 0);
	}

	private function assertPosition(Bot $Bot, $position)
	{
		$this->assertEquals( $position, $Bot->position());
	}

	public function testBotIsInitializedToZero() {
		$this->assertPosition($this->bot, array(0, 0));
	}

	public function testBotIsOrientedToNorthByDefault() {
		$this->assertEquals( 'N', $this->bot->orientation());
	}

	public function testBotIsSetToOrientationSouth() {
		$this->bot = new Bot(45, 18, 'S');
		$this->assertEquals( 'S', $this->bot->orientation());
	}

	public function testBotIsInitializedToRandom() {
		$this->bot = new Bot(45, 18);
		$this->assertPosition($this->bot, array(45, 18));
	}

	public function testBotMoveForward()
	{
		$this->bot->execute('f');
		$this->assertPosition($this->bot, array(0, 1));
	}

	public function testBotMoveBackard()
	{
		$this->bot->execute('b');
		$this->assertPosition($this->bot, array(0, -1));
 	}

	public function testBotMoveDoubleForward()
	{
		$this->bot->execute('f');
		$this->bot->execute('f');
		$this->assertPosition($this->bot, array(0, 2));
	}

	public function testBotMoveDoubleBackward()
	{
		$this->bot->execute('b');
		$this->bot->execute('b');
		$this->assertEquals( array(0, -2), $this->bot->position());
	}

	public function testBotMoveDoubleBackwardWhenSingleCommand()
	{
		$this->bot->execute('bb');
		$this->assertEquals( array(0, -2), $this->bot->position());
	}

	public function testTurnRightFroNorthGivesEast()
	{
		$this->bot->execute('r');
		$this->assertEquals( 'E', $this->bot->orientation());
	}

	public function testTurnRightFromEastGivesSouth()
	{
		$this->bot = new Bot(45, 18, 'E');
		$this->bot->execute('r');
		$this->assertEquals( 'S', $this->bot->orientation());
	}
	public function testTurnRightFromSouthGivesWest()
	{
		$this->bot = new Bot(45, 18, 'S');
		$this->bot->execute('r');
		$this->assertEquals( 'W', $this->bot->orientation());
	}
	public function testTurn360FromDefault() {
		$this->bot->execute('rrrr');
		$this->assertEquals( 'N', $this->bot->orientation());
	}
	public function testTurnLeftFromNorthGivesWest() {
		$this->bot->execute('l');
		$this->assertEquals('W', $this->bot->orientation());
	}
	public function testTurnLeftTwiceFromNorthGivesWest() {
		$this->bot->execute('ll');
		$this->assertEquals('S', $this->bot->orientation());
	}
	public function testTurnLeftAndGoForward()
	{
		$this->bot->execute('lf');
		$this->assertPosition($this->bot, array(-1, 0));
	}
	public function testTurnLeftTwiceAndGoForward()
	{
		$this->bot->execute('llf');
		$this->assertPosition($this->bot, array(0, -1));
	}
}