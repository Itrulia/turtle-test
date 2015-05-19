<?php namespace TurtleTest\Repositories;

use Illuminate\Database\Eloquent\Model;
use TurtleTest\Exceptions\UnauthorizedException;
use Illuminate\Contracts\Auth\Guard;

abstract class Repository implements RepositoryInterface
{
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard $aAuth
	 *
	 */
	public function __construct(Guard $aAuth)
	{
		$this->auth = $aAuth;
	}

	/**
	 * @param array $aData
	 *
	 * @throws UnauthorizedException
	 * @return Model
	 */
	public function create(array $aData)
	{
		if (!$this->canCreate()) {
			throw new UnauthorizedException;
		}

		return $this->getModel()->create($aData);
	}

	/**
	 * @param Model $aModel
	 * @param array $aData
	 *
	 * @throws UnauthorizedException
	 * @return Model
	 */
	public function update(Model $aModel, array $aData)
	{
		if (!$this->canUpdate($aModel)) {
			throw new UnauthorizedException;
		}

		return $aModel->update($aData);
	}

	/**
	 * @param Model $aModel
	 * @param bool $aForce
	 *
	 * @throws UnauthorizedException
	 * @return void
	 */
	public function delete(Model $aModel, $aForce = false)
	{
		if (!$this->canDelete($aModel)) {
			throw new UnauthorizedException;
		}

		if ($aForce) {
			$aModel->forceDelete();
		} else {
			$aModel->delete();
		}
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return Model
	 * @throws UnauthorizedException
	 */
	public function show(Model $aModel)
	{
		if (!$this->canShow($aModel)) {
			throw new UnauthorizedException;
		}

		return $aModel;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected abstract function canDelete(Model $aModel);

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected abstract function canUpdate(Model $aModel);

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected abstract function canShow(Model $aModel);

	/**
	 * @return boolean
	 */
	protected abstract function canCreate();

	/**
	 * @return Model
	 */
	protected abstract function getModel();
}