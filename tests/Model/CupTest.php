<?php namespace Tests\Model;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Cup;

class CupTest extends TestCase
{
	public function testGetWinner()
	{
		$winnerGateway = Mockery::mock('TurtleTest\Services\Gateway\WinnerInterface', function (MockInterface $mock) {
			$mock->shouldReceive('getWinner')->with(1)->andReturn('TEAM');
		});

		$result = new Cup($winnerGateway);
		$result->id = 1;

		$expected = 'TEAM';

		$this->assertEquals($expected, $result->winner);
	}
}

