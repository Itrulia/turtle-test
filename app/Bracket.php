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
}