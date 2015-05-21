<?php namespace Tests\Service\Factory;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Factory\Winner;

class WinnerTest extends TestCase
{

	/**
	 * @var \TurtleTest\Services\Factory\Winner
	 */
	protected $factory;

	public function setUp()
	{
		parent::setUp();
		$this->factory = new Winner($this->app);
	}

	public function testCreate()
	{
		$result = $this->factory->create([]);

		$this->assertTrue($result instanceof \TurtleTest\Winner);
	}

	public function testCreateMany()
	{
		$result = $this->factory->createMany([[], []]);

		$this->assertTrue(($result[0] instanceof \TurtleTest\Winner) && ($result[1] instanceof \TurtleTest\Winner));
	}
}
