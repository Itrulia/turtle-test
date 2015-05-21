<?php namespace Tests\Service\Factory;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Services\Factory\Cup;

class CupTest extends TestCase {

	/**
	 * @var \TurtleTest\Services\Factory\Cup
	 */
	protected $factory;

	public function __construct($name = null, array $data = [], $dataName = '') {
		parent::__construct($name, $data, $dataName);

		$this->factory = new Cup(Mockery::mock('Illuminate\Foundation\Application', function(MockInterface $mock) {
			$mock->shouldDeferMissing();
		}));
	}

	public function testCreate() {
		$result = $this->factory->create([]);

		$this->assertTrue($result instanceof \TurtleTest\Cup);
	}

	public function testCreateMany() {
		$result = $this->factory->createMany([[], []]);

		$this->assertTrue(($result[0] instanceof \TurtleTest\Cup) && ($result[1] instanceof \TurtleTest\Cup));
	}
}

