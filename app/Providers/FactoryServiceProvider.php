<?php namespace TurtleTest\Providers;

use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind('TurtleTest\Services\Factory\CupInterface', 'TurtleTest\Services\Factory\Cup');
		$this->app->bind('TurtleTest\Services\Factory\RankingInterface', 'TurtleTest\Services\Factory\Ranking');
		$this->app->bind('TurtleTest\Services\Factory\TeamInterface', 'TurtleTest\Services\Factory\Team');
		$this->app->bind('TurtleTest\Services\Factory\WinnerInterface', 'TurtleTest\Services\Factory\Winner');
	}
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [
			'TurtleTest\Services\Factory\CupInterface',
			'TurtleTest\Services\Factory\RankingInterface',
			'TurtleTest\Services\Factory\TeamInterface',
			'TurtleTest\Services\Factory\WinnerInterface',
		];
	}
}