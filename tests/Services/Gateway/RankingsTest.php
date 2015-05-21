<?php namespace Tests\Service\Gateway;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Gateway\Rankings;

class RankingsTest extends TestCase
{

	public function testGetRankings()
	{
		$response = Mockery::mock('GuzzleHttp\Message\ResponseInterface', function (MockInterface $mock) {
			$mock->shouldReceive('json')->times(1)->withNoArgs()->andReturn(['ranking' => ['JSON']]);
		});

		$client = Mockery::mock('GuzzleHttp\Client', function (MockInterface $mock) use ($response) {
			$mock->shouldReceive('get')->times(1)->with('http://play.eslgaming.com/api/leagues/1234/ranking')->andReturn($response);
		});

		$factory = Mockery::mock('TurtleTest\Services\Factory\Ranking', function (MockInterface $mock) {
			$mock->shouldReceive('createMany')->times(1)->with(['JSON'])->andReturn('RANKINGS');
		});

		$app = new Rankings($client, $factory);

		$result = $app->getRankings(1234);
		$expected = 'RANKINGS';

		$this->assertEquals($expected, $result);
	}

}
