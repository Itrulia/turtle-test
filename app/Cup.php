<?php namespace TurtleTest;

use TurtleTest\Services\Gateway\Winner;

/**
 * @property int $id
 * @property Team $winner
 * @property int $teamSize
 */
class Cup extends Model {
	/**
	 * @var \TurtleTest\Services\Gateway\Winner
	 */
	protected $winnerGateway;

	/**
	 * @param \TurtleTest\Services\Gateway\Winner $aWinnerGateway
	 */
	public function __construct(Winner $aWinnerGateway)
	{
		$this->winnerGateway = $aWinnerGateway;
	}

	/**
	 * @return Team
	 */
	public function getWinnerAttribute() {
		if (!isset($this->data['winner'])) {
			$this->data['winner'] = $this->winnerGateway->getWinner($this->id);
		}

		return $this->data['winner'];
	}
}