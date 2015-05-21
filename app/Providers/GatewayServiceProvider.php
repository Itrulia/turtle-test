<?php namespace TurtleTest\Providers;

use Illuminate\Support\ServiceProvider;

class GatewayServiceProvider extends ServiceProvider
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
		$this->app->bind('TurtleTest\Services\Gateway\CupsInterface', 'TurtleTest\Services\Gateway\Cups');
		$this->app->bind('TurtleTest\Services\Gateway\RankingsInterface', 'TurtleTest\Services\Gateway\Rankings');
		$this->app->bind('TurtleTest\Services\Gateway\WinnerInterface', 'TurtleTest\Services\Gateway\Winner');
	}
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [
			'TurtleTest\Services\Gateway\CupsInterface',
			'TurtleTest\Services\Gateway\RankingsInterface',
			'TurtleTest\Services\Gateway\WinnerInterface',
		];
	}
}