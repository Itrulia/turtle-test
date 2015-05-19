<?php

Route::get('/', function() {

	/**
	 * @var \TurtleTest\Services\Gateway\Cups $cupGateway
	 */
	$cupGateway = App::make('\TurtleTest\Services\Gateway\Cups');
	$cups = $cupGateway->getCups();

	$teamSizes = new \Illuminate\Support\Collection();

	foreach($cups as $cup) {
		
	}

	dd($teamSizes);
});