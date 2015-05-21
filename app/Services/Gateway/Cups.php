<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Services\Factory\Cup as CupFactory;

class Cups extends Gateway implements CupsInterface
{

	/**
	 * @var \TurtleTest\Services\Factory\Cup
	 */
	protected $factory;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\Cup $aFactory
	 */
	public function __construct(Client $aClient, CupFactory $aFactory)
	{
		parent::__construct($aClient);
		$this->factory = $aFactory;
	}


	public function getCups() {
		$response = $this->client->get('http://play.eslgaming.com/api/leagues?types=cup&states=finished&limit.total=25&path=%2Fplay%2Fworldoftanks%2Feurope%2F');

		return $this->factory->createMany($response->json());
	}
}