<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Services\Factory\Ranking as RankingFactory;

class Rankings extends Gateway {

	/**
	 * @var \TurtleTest\Services\Factory\Ranking
	 */
	protected $factory;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\Ranking $aFactory
	 */
	public function __construct(Client $aClient, RankingFactory $aFactory)
	{
		parent::__construct($aClient);
		$this->factory = $aFactory;
	}

	/**
	 * @param $aCupId
	 * @return array
	 */
	public function getRankings($aCupId) {
		$response = $this->client->get('http://play.eslgaming.com/api/leagues/' . $aCupId . '/ranking');

		return $this->factory->createMany($response->json()['ranking']);
	}
}