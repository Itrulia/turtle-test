<?php namespace TurtleTest\Http\Controllers;

use TurtleTest\Bracket;
use TurtleTest\Services\Fetch\FetchBracketsInterface;
use TurtleTest\Services\Gateway\CupsInterface;

class IndexController extends Controller
{

	/**
	 * @param \TurtleTest\Services\Gateway\CupsInterface $aCupGateway
	 * @param \TurtleTest\Services\Fetch\FetchBracketsInterface $aFetch
	 * @return array
	 */
	public function index(CupsInterface $aCupGateway, FetchBracketsInterface $aFetch)
	{
		$cups = $aCupGateway->getCups();
		$brackets = $aFetch->fetchBrakets($cups);

		// Sort brackets teamsize by ASC
		$brackets = $brackets->sortBy(function(Bracket $item) {
			return $item->teamSize;
		});

		return $brackets;
	}
}
