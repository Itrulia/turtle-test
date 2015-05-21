<?php namespace TurtleTest\Services\Factory;

use Illuminate\Foundation\Application;

abstract class Factory implements FactoryInterface
{
	/**
	 * @var \TurtleTest\Model|String
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

	/**
	 * @param array $aData
	 * @return \TurtleTest\Model
	 */
	public function create(array $aData) {
		$model = $this->app->make($this->model);

		foreach($aData as $key => $value) {
			$model->$key = $value;
		}

		return $model;
	}

	/**
	 * @param array $aData
	 * @return array
	 */
	public function createMany(array $aData) {
		$models = [];

		foreach($aData as $model) {
			$models[] = $this->create($model);
		}

		return $models;
	}
}