<?php namespace Tests\Service\Factory;

use TestCase;
use Mockery;
use TurtleTest\Services\Factory\Cup;

class CupTest extends TestCase
{

	/**
	 * @var \TurtleTest\Services\Factory\Cup
	 */
	protected $factory;


	public function setUp()
	{
		parent::setUp();
		$this->factory = new Cup($this->app);
	}


	public function testCreate()
	{
		$result = $this->factory->create([]);

		$this->assertTrue($result instanceof \TurtleTest\Cup);
	}

	public function testCreateMany()
	{
		$result = $this->factory->createMany([[], []]);

		$this->assertTrue(($result[0] instanceof \TurtleTest\Cup) && ($result[1] instanceof \TurtleTest\Cup));
	}
}

