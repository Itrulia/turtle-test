<?php namespace TurtleTest\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

	/**
	 * @param array $aData
	 *
	 * @return Model
	 */
	public function create(array $aData);

	/**
	 * @param Model $aModel
	 * @param array $aData
	 *
	 * @return Model
	 */
	public function update(Model $aModel, array $aData);

	/**
	 * @param Model $aModel
	 * @param bool $aForce
	 *
	 * @return void
	 */
	public function delete(Model $aModel, $aForce = false);

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return Model
	 */
	public function show(Model $aModel);
}