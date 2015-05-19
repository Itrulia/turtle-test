<?php

Route::get('/', function() {

	/**
	 * @var \TurtleTest\Services\Gateway\Cups $cups
	 */
	$cups = App::make('\TurtleTest\Services\Gateway\Cups');

	/**
	 * @var \TurtleTest\Services\Gateway\Winner $rankings
	 */
	$rankings = App::make('\TurtleTest\Services\Gateway\Winner');

	foreach($cups->getCups() as $cup) {
		var_dump($rankings->getWinner($cup->id));
	}
});