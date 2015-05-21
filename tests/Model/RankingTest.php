<?php namespace Tests\Model;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Ranking;

class RankingTest extends TestCase
{
	/**
	 * @var \TurtleTest\Ranking
	 */
	protected $ranking;

	public function setUp()
	{
		parent::setUp();

		$teamFactory = Mockery::mock('TurtleTest\Services\Factory\TeamInterface', function (MockInterface $mock) {
			$mock->shouldReceive('create')->with(['TEAM'])->andReturn('TEAM_OBJ');
		});

		$this->ranking = new Ranking($teamFactory);
	}


	public function testSetTeam()
	{
		$this->ranking->team = ['TEAM'];
		$expected = 'TEAM_OBJ';

		$this->assertEquals($expected, $this->ranking->team);
	}

	public function testSetUser()
	{
		$this->ranking->user = ['TEAM'];
		$expected = 'TEAM_OBJ';

		$this->assertEquals($expected, $this->ranking->team);
	}
}

