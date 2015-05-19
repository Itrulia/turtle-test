<?php namespace TurtleTest\Repositories;

use TurtleTest\Project as ProjectModel;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Queue;
use Carbon\Carbon;

class Project extends Repository implements ProjectRepositoryInterface
{
	/**
	 * @param array $aData
	 *
	 * @return Model
	 */
	public function create(array $aData)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if (!$user->can('create_foreign_project') || !isset($aData['user_id'])) {
			$aData['user_id'] = $user->id;
		}

		return parent::create($aData);
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected function canShow(Model $aModel)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($aModel->visibility_id === 1
			|| $user->id == $aModel->user_id
			|| $user->can('see_foreign_project')
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
	protected function canDelete(Model $aModel)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($user->id == $aModel->user_id
			|| $user->can('delete_foreign_project')
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
	protected function canUpdate(Model $aModel)
	{
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($user->id == $aModel->user_id
			|| $user->can('edit_foreign_project')
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
		return new ProjectModel;
	}
}