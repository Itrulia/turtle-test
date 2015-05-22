<?php namespace TurtleTest;

use TurtleTest\Services\Gateway\WinnerInterface;

/**
 * @property int $id
 * @property Team $winner
 * @property int $teamSize
 */
class Cup extends Model {
	/**
	 * @var \TurtleTest\Services\Gateway\WinnerInterface
	 */
	protected $winnerGateway;

	/**
	 * @param \TurtleTest\Services\Gateway\WinnerInterface $aWinnerGateway
	 */
	public function __construct(WinnerInterface $aWinnerGateway)
	{
		$this->winnerGateway = $aWinnerGateway;
	}

	/**
	 * @return Team
	 */
	public function getWinnerAttribute() {
		if (!array_key_exists('winner', $this->data)) {
			$this->data['winner'] = $this->winnerGateway->getWinner($this->id);
		}

		return $this->data['winner'];
	}
}