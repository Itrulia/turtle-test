<?php

Route::get('/', function() {

	/**
	 * @var \TurtleTest\Services\Gateway\Cups $cupGateway
	 */
	$cupGateway = App::make('\TurtleTest\Services\Gateway\Cups');
	$cups = $cupGateway->getCups();

	$teamSizes = new \Illuminate\Support\Collection();

	$winners = [];

	foreach($cups as $cup) {
		/**
		 * @var \TurtleTest\Cup $cup
		 * @var \TurtleTest\Bracket $bracket
		 */
		$bracket = $teamSizes->filter(function(\TurtleTest\Bracket $item) use ($cup) {
			return $item->teamSize == $cup->teamSize;
		})->first();

		if (empty($bracket)) {
			$bracket = new \TurtleTest\Bracket();
			$bracket->teamSize = $cup->teamSize;

			$teamSizes->push($bracket);
		}

		if (is_null($cup->winner)) {
			continue;
		}

		$winners[] = $cup->winner->id;

		/**
		 * @var \TurtleTest\Winner $winner
		 */
		$winner = $bracket->winners->filter(function(\TurtleTest\Winner $item) use ($cup) {
			return $item->id === $cup->winner->id;
		})->first();

		if (empty($winner)) {
			$winner = new \TurtleTest\Winner();
			$winner->id = $cup->winner->id;
			$winner->wins = 0;

			$bracket->winners->push($winner);
		}

		$winner->wins++;
	}

	$teamSizes->sortBy(function(\TurtleTest\Bracket $item) {
		return $item->teamSize;
	});


	return $teamSizes->toArray();
});