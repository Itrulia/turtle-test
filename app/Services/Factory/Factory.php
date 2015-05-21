<?php namespace TurtleTest\Services\Factory;

use Illuminate\Foundation\Application;

abstract class Factory implements FactoryInterface
{
	/**
	 * @var \TurtleTest\Model
	 */
	protected $model;

	/**
	 * @var \Illuminate\Foundation\Application
	 */
	protected $app;

	/**
	 * @param \Illuminate\Foundation\Application $aApp
	 */
	public function __construct(Application $aApp)
	{
		$this->app = $aApp;
	}

	public function create(array $aData) {
		$model = $this->app->make($this->model);

		foreach($aData as $key => $value) {
			$model->$key = $value;
		}

		return $model;
	}

	public function createMany(array $aData) {
		$models = [];

		foreach($aData as $model) {
			$models[] = $this->create($model);
		}

		return $models;
	}
}