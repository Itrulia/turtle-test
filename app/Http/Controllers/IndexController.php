<?php namespace TurtleTest\Http\Controllers;

use Illuminate\Support\Collection;
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

		// This fixes the issues with the index keys being in the json
		// when the array keys are not properly indexed
		// this will reindex the array
		return new Collection(array_values($brackets->toArray()));
	}
}
