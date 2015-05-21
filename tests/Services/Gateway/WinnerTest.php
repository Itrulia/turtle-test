<?php namespace Tests\Service\Gateway;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Gateway\Winner;

class WinnerTest extends TestCase
{

	public function testGetWinner()
	{
		$client = Mockery::mock('GuzzleHttp\Client', function (MockInterface $mock) {
			$mock->shouldNotReceive('get');
		});

		$ranking1 = new \StdClass();
		$ranking1->position = 1;
		$ranking1->team = new \StdClass();
		$ranking1->team->id = 2;

		$ranking2 = new \StdClass();
		$ranking2->position = 2;
		$ranking2->team = new \StdClass();
		$ranking2->team->id = 3;

		$rankings = Mockery::mock('TurtleTest\Services\Gateway\Rankings', function (MockInterface $mock) use ($ranking1, $ranking2) {
			$mock->shouldReceive('getRankings')->times(1)->with(1234)->andReturn([
				$ranking1,
				$ranking2
			]);
		});

		$factory = Mockery::mock('TurtleTest\Services\Factory\Team', function (MockInterface $mock) use ($ranking1) {
			$mock->shouldNotReceive('createMany');
			$mock->shouldReceive('create')->times(1)->with(['id' => 2])->andReturn($ranking1);
		});

		$app = new Winner($client, $factory, $rankings);

		$result = $app->getWinner(1234)->team->id;
		$expected = 2;

		$this->assertEquals($expected, $result);
	}

}
