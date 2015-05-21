<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Ranking;
use TurtleTest\Services\Factory\TeamInterface as TeamFactoryInterface;

class Winner extends Gateway implements WinnerInterface
{

	/**
	 * @var \TurtleTest\Services\Factory\TeamInterface
	 */
	protected $factory;

	/**
	 * @var \TurtleTest\Services\Gateway\RankingsInterface
	 */
	protected $rankings;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\TeamInterface $aFactory
	 * @param \TurtleTest\Services\Gateway\RankingsInterface $aRankings
	 */
	public function __construct(Client $aClient, TeamFactoryInterface $aFactory, RankingsInterface $aRankings)
	{
		parent::__construct($aClient);
		$this->factory = $aFactory;
		$this->rankings = $aRankings;
	}

	/**
	 * @param $aCupId
	 * @return \TurtleTest\Winner
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