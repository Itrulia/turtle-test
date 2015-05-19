<?php namespace TurtleTest;

use TurtleTest\Services\Factory\Team as TeamFactory;

class Ranking extends Model {

	/**
	 * @var \TurtleTest\Services\Factory\Team
	 */
	protected $factory;

	/**
	 * @param \TurtleTest\Services\Factory\Team $aFactory
	 */
	public function __construct(TeamFactory $aFactory)
	{
		$this->factory = $aFactory;
	}

	/**
	 * @param $aData
	 */
	public function setTeamAttribute($aData) {
		$this->data['team'] = $this->factory->create($aData);
	}

	/**
	 * User is alias for Team
	 * @param $aData
	 */
	public function setUserAttribute($aData) {
		$this->setTeamAttribute($aData);
	}
}