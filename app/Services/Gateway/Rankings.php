<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Services\Factory\RankingInterface as RankingFactoryInterface;

class Rankings extends Gateway implements RankingsInterface
{

	/**
	 * @var \TurtleTest\Services\Factory\RankingInterface
	 */
	protected $factory;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\RankingInterface $aFactory
	 */
	public function __construct(Client $aClient, RankingFactoryInterface $aFactory)
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