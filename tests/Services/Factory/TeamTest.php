<?php namespace Tests\Service\Factory;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Factory\Team;

class TeamTest extends TestCase
{

	/**
	 * @var \TurtleTest\Services\Factory\Team
	 */
	protected $factory;

	public function setUp()
	{
		parent::setUp();
		$this->factory = new Team($this->app);
	}

	public function testCreate()
	{
		$result = $this->factory->create([]);

		$this->assertTrue($result instanceof \TurtleTest\Team);
	}

	public function testCreateMany()
	{
		$result = $this->factory->createMany([[], []]);

		$this->assertTrue(($result[0] instanceof \TurtleTest\Team) && ($result[1] instanceof \TurtleTest\Team));
	}
}
