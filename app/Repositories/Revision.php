<?php namespace TurtleTest\Repositories;

use TurtleTest\Image as ImageModel;
use TurtleTest\Revision as RevisionModel;
use Illuminate\Database\Eloquent\Model;

class Revision extends Repository implements RevisionRepositoryInterface
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

		if (!$user->can('create_foreign_revision') || !isset($aData['user_id'])) {
			$aData['user_id'] = $user->id;
		}

		if (!$aData['image'] instanceof ImageModel) {
			throw new \RuntimeException;
		}

		$aData['image_id'] = $aData['image']->id;

		$model = parent::create($aData);

//		Queue::push('Queue\OptimizeRevision', ['revision' => $model]);

		return $model;
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 * @param bool $aForce
	 */
	public function delete(Model $aModel, $aForce = false)
	{
		/**
		 * @var RevisionModel $aModel
		 */
		if ($aForce || !method_exists($aModel, 'forceDelete')) {
			\File::delete($aModel->folder . $aModel->image);
		}

		parent::delete($aModel, $aForce);
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
		\Log::alert($user);

		if ($user->id == $aModel->project->user_id
			|| $user->can('delete_foreign_revision')
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
			|| $user->can('edit_foreign_revision')
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
		/**
		 * @var \TurtleTest\User $user
		 */
		$user = $this->auth->user();

		if ($user->id == $aModel->user_id
			|| $user->can('see_foreign_revision')
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
		return new RevisionModel;
	}
}