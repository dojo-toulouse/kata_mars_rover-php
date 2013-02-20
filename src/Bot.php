<?php
/**
* */
class Bot
{
	private $x;
	private $y;
	private $orientation;

	private $transitions = array(
		'N' => array(
			'clockwise' =>'E',
			'counterClockwise' =>'W',
			'movingY'	=> 1,
			'movingX'	=> 0,
		),
		'E' => array(
			'clockwise' =>'S',
			'counterClockwise' =>'N',
			'movingY'	=> 0,
			'movingX'	=> 1,
		),
		'S' => array(
			'clockwise' =>'W',
			'counterClockwise' =>'E',
			'movingY'	=> -1,
			'movingX'	=> 0,
		),
		'W' => array(
			'clockwise' =>'N',
			'counterClockwise' =>'S',
			'movingY'	=> 0,
			'movingX'	=> -1,
		),
	);

	public function __construct($x, $y , $orientation ='N')
	{
		$this->x = $x;
		$this->y = $y;
		$this->orientation = $orientation;
	}

	public function position() 
	{
		return array($this->x, $this->y);
	}

	public function orientation()
	{
		return $this->orientation ;
	}

	public function execute($instruction)
	{
		$commands = str_split($instruction);
		foreach ($commands as $command) {
			$this->executeCommand($command);
		}
	}

	private function moveForward()
	{
		$this->x += $this->transitions[$this->orientation]['movingX'];
		$this->y += $this->transitions[$this->orientation]['movingY']; 
	}
	private function moveBackward()
	{
		$this->y--;
	}
	private function executeCommand($command) {
		switch ($command)
		{
			case 'r':
				$this->turnRight();
				break;
			case 'l':
				$this->turnLeft();
				break;
			case 'f':
				$this->moveForward();
				break;
			case 'b':
				$this->moveBackward();
				break;
		}
	}

	private function turnRight()
	{
		$this->orientation = $this->transitions[$this->orientation]['clockwise'];
	}

	private function turnLeft() 
	{
		$this->orientation = $this->transitions[$this->orientation]['counterClockwise'];
	}
 }