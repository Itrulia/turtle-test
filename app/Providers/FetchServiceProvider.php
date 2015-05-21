<?php namespace TurtleTest\Providers;

use Illuminate\Support\ServiceProvider;

class FetchServiceProvider extends ServiceProvider
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
		$this->app->bind('TurtleTest\Services\Fetch\FetchBracketsInterface', 'TurtleTest\Services\Fetch\FetchBrackets');
	}
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return ['TurtleTest\Services\Fetch\FetchBracketsInterface'];
	}
}