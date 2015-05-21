<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;
use TurtleTest\Services\Factory\CupInterface as CupFactoryInterface;

class Cups extends Gateway implements CupsInterface
{

	/**
	 * @var \TurtleTest\Services\Factory\CupInterface
	 */
	protected $factory;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 * @param \TurtleTest\Services\Factory\CupInterface $aFactory
	 */
	public function __construct(Client $aClient, CupFactoryInterface $aFactory)
	{
		parent::__construct($aClient);
		$this->factory = $aFactory;
	}


	public function getCups() {
		$response = $this->client->get('http://play.eslgaming.com/api/leagues?types=cup&states=finished&limit.total=25&path=%2Fplay%2Fworldoftanks%2Feurope%2F');

		return $this->factory->createMany($response->json());
	}
}