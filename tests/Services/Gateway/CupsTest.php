<?php namespace Tests\Service\Gateway;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Gateway\Cups;

class CupsTest extends TestCase {

	public function __construct($name = null, array $data = [], $dataName = '') {
		parent::__construct($name, $data, $dataName);
	}

	public function testGetCups()
	{
		$response = Mockery::mock('GuzzleHttp\Message\ResponseInterface', function(MockInterface $mock) {
			$mock->shouldReceive('json')->times(1)->withNoArgs()->andReturn(['JSON']);
		});

		$client = Mockery::mock('GuzzleHttp\Client', function(MockInterface $mock) use($response) {
			$mock->shouldReceive('get')->times(1)->andReturn($response);
		});

		$factory = Mockery::mock('TurtleTest\Services\Factory\Cup', function(MockInterface $mock) {
			$mock->shouldReceive('createMany')->times(1)->with(['JSON'])->andReturn('CUPS');
		});

		$app = new Cups($client, $factory);

		$result = $app->getCups();
		$expected = 'CUPS';

		$this->assertEquals($expected, $result);
	}

}
