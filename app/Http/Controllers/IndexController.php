<?php namespace TurtleTest\Http\Controllers;

use Illuminate\Support\Collection;
use TurtleTest\Bracket;
use TurtleTest\Cup;
use TurtleTest\Services\Gateway\CupsInterface;
use TurtleTest\Team;
use TurtleTest\Winner;

class IndexController extends Controller
{

	/**
	 * @param \Illuminate\Support\Collection $aBrackets
	 * @param \TurtleTest\Cup $aCup
	 * @return \TurtleTest\Bracket
	 */
	protected function addBracket(Collection $aBrackets, Cup $aCup)
	{
		$bracket = $aBrackets->filter(function(\TurtleTest\Bracket $item) use ($aCup) {
			return $item->teamSize == $aCup->teamSize;
		})->first();

		if (empty($bracket)) {
			$bracket = new \TurtleTest\Bracket();
			$bracket->teamSize = $aCup->teamSize;

			$aBrackets->push($bracket);
		}

		return $bracket;
	}

	/**
	 * @param \TurtleTest\Bracket $aBracket
	 * @param \TurtleTest\Team $aWinner
	 * @return \TurtleTest\Winner
	 */
	protected function addWinner(Bracket $aBracket, Team $aWinner)
	{
		$winner = $aBracket->winners->filter(function(\TurtleTest\Winner $item) use ($aWinner) {
			return $item->id === $aWinner->id;
		})->first();

		if (empty($winner)) {
			$winner = new Winner();
			$winner->id = $aWinner->id;
			$winner->wins = 0;

			$aBracket->winners->push($winner);
		}

		return $winner;
	}

	/**
	 * @param \TurtleTest\Services\Gateway\CupsInterface $aCupGateway
	 * @return array
	 */
	public function index(CupsInterface $aCupGateway)
	{
		$cups = $aCupGateway->getCups();
		$brackets = new Collection();

		foreach ($cups as $cup) {
			/**
			 * @var \TurtleTest\Cup $cup
			 */
			$bracket = $this->addBracket($brackets, $cup);

			if (is_null($cup->winner)) {
				continue;
			}

			$winner = $this->addWinner($bracket, $cup->winner);

			$winner->wins++;
		}

		// Sort out brackets without a winner
		$brackets = $brackets->filter(function(Bracket $item) {
			return !$item->winners->isEmpty();
		});

		// Sort brackets teamsize by ASC
		$brackets = $brackets->sortBy(function(Bracket $item) {
			return $item->teamSize;
		});


		return $brackets;
	}
}
