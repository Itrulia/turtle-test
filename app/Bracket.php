<?php namespace TurtleTest;

use Illuminate\Support\Collection;

/**
 * @property int $teamSize
 * @property \Illuminate\Support\Collection $winners
 */
class Bracket extends Model {

	/**
	 * Init
	 */
	public function __construct()
	{
		$this->winners = new Collection();
	}

	/**
	 * Map teamSize to teamsize
	 * @return mixed
	 */
	public function getTeamSizeAttribute() {
		return $this->data['teamsize'];
	}

	/**
	 * Map teamSize to teamsize
	 * @param $aAttribute
	 */
	public function setTeamSizeAttribute($aAttribute) {
		$this->data['teamsize'] = $aAttribute;
	}
}