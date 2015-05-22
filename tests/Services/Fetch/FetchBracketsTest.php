<?php namespace Tests\Service\Fetch;

use TestCase;
use Mockery;
use Mockery\MockInterface;
use TurtleTest\Bracket;
use TurtleTest\Services\Fetch\FetchBrackets;
use StdClass;
use TurtleTest\Winner;

class FetchBracketsTest extends TestCase
{
	/**
	 * @var \TurtleTest\Services\Fetch\FetchBrackets
	 */
	protected $fetch;

	public function setUp()
	{
		parent::setUp();
		$this->fetch = new FetchBrackets();
	}


	public function testEmptyBrackets() {
		$result = $this->fetch->fetchBrakets([
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 11;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 2;
				$mock->winner = null;
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 3;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 33;
				});
			}),
		]);

		$result = $result->filter(function(Bracket $item) {
			return $item->winners->isEmpty();
		});

		$this->assertTrue($result->count() === 0);
	}

	public function testMultipleWinner() {
		$result = $this->fetch->fetchBrakets([
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 11;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 22;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 3;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 33;
				});
			}),
		]);

		$result = $result->filter(function(Bracket $item) {
			return $item->teamsize === 1;
		})->first();

		/**
		 * @var Bracket $result
		 */
		$this->assertTrue($result->winners->count() === 2);
	}

	public function testMultipleWins() {
		$result = $this->fetch->fetchBrakets([
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 11;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 11;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 3;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 33;
				});
			}),
		]);

		$result = $result->filter(function(Bracket $item) {
			return $item->teamsize === 1;
		})->first();

		/**
		 * @var Bracket $result
		 */
		$result = $result->winners->first();

		/**
		 * @var Winner $result
		 */
		$this->assertTrue($result->wins === 2);
	}

	public function testDuplicateBrackets()
	{
		$result = $this->fetch->fetchBrakets([
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 11;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 3;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 22;
				});
			}),
			Mockery::mock('TurtleTest\Cup', function (MockInterface $mock) {
				$mock->shouldDeferMissing();
				$mock->teamSize = 1;
				$mock->winner = Mockery::mock('TurtleTest\Team', function (MockInterface $mock) {
					$mock->id = 33;
				});
			}),
		]);

		$result = $result->filter(function(Bracket $item) {
			return $item->teamsize === 1;
		});

		$this->assertTrue($result->count() === 1);
	}
}
