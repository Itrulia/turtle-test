<?php namespace Tests\Service\Factory;

use TestCase;
use Mockery;
use TurtleTest\Services\Factory\Ranking;

class RankingTest extends TestCase
{

	/**
	 * @var \TurtleTest\Services\Factory\Ranking
	 */
	protected $factory;

	public function setUp()
	{
		parent::setUp();
		$this->factory = new Ranking($this->app);
	}

	public function testCreate()
	{
		$result = $this->factory->create([]);

		$this->assertTrue($result instanceof \TurtleTest\Ranking);
	}

	public function testCreateMany()
	{
		$result = $this->factory->createMany([[], []]);

		$this->assertTrue(($result[0] instanceof \TurtleTest\Ranking) && ($result[1] instanceof \TurtleTest\Ranking));
	}
}
