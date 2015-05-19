<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Ranking;
use TurtleTest\Services\Factory\Team as TeamFactory;

class Winner extends Gateway {

	/**
	 * @var \TurtleTest\Services\Factory\Winner
	 */
	protected $factory;

	/**
	 * @var \TurtleTest\Services\Gateway\Rankings
	 */
	protected $rankings;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\Team $aFactory
	 * @param \TurtleTest\Services\Gateway\Rankings $aRankings
	 */
	public function __construct(Client $aClient, TeamFactory $aFactory, Rankings $aRankings)
	{
		parent::__construct($aClient);
		$this->factory = $aFactory;
		$this->rankings = $aRankings;
	}

	/**
	 * @param $aCupId
	 * @return \TurtleTest\Model|null
	 */
	public function getWinner($aCupId) {
		$rankings = $this->rankings->getRankings($aCupId);

		$winner = [];

		foreach($rankings as $ranking) {
			/**
			 * @var Ranking $ranking
			 */

			if ($ranking->position === 1) {
				$winner = [
					'id' => $ranking->team->id
				];

				break;
			}
		}

		if (empty($winner)) {
			return null;
		}

		return $this->factory->create($winner);
	}
}