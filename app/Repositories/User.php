<?php namespace TurtleTest\Repositories;

use TurtleTest\User as UserModel;
use Illuminate\Database\Eloquent\Model;

class User extends Repository
{
	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected function canDelete(Model $aModel)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($user->id == $aModel->user_id
			|| $user->can('delete_foreign_user')
		) {
			return true;
		}

		return false;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected function canShow(Model $aModel)
	{
		return true;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected function canUpdate(Model $aModel)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($user->id == $aModel->user_id
			|| $user->can('edit_foreign_user')
		) {
			return true;
		}

		return false;
	}

	/**
	 * @return boolean
	 */
	protected function canCreate()
	{
		return true;
	}

	/**
	 * @return Model
	 */
	protected function getModel()
	{
		return new UserModel;
	}
}