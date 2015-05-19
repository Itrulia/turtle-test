<?php namespace TurtleTest\Services\Gateway;

use GuzzleHttp\Client;

abstract class Gateway {

	/**
	 * @var \GuzzleHttp\Client
	 */
	protected $client;

	/**
	 * @param \GuzzleHttp\Client $aClient
	 */
	public function __construct(Client $aClient)
	{
		$this->client = $aClient;
	}
}