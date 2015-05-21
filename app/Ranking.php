<?php namespace TurtleTest;

use TurtleTest\Services\Factory\TeamInterface as TeamFactoryInterface;

/**
 * @property int $position
 * @property Team $team
 */
class Ranking extends Model {

	/**
	 * @var \TurtleTest\Services\Factory\TeamInterface
	 */
	protected $factory;

	/**
	 * @param \TurtleTest\Services\Factory\TeamInterface $aFactory
	 */
	public function __construct(TeamFactoryInterface $aFactory)
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