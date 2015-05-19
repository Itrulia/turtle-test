<?php namespace TurtleTest\Repositories;

use TurtleTest\Image as ImageModel;
use TurtleTest\Services\File\UploadInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Constraint;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as ImageFile;

class Image extends Repository implements ImageRepositoryInterface
{
	/**
	 * @var UploadInterface
	 */
	protected $upload;

	/**
	 * @param Guard $aAuth
	 * @param UploadInterface $aUpload
	 */
	public function __construct(Guard $aAuth, UploadInterface $aUpload)
	{
		parent::__construct($aAuth);
		$this->upload = $aUpload;
	}

	/**
	 * @param array $aData
	 *
	 * @return Model
	 * @throws \TurtleTest\Exceptions\UnauthorizedException
	 */
	public function create(array $aData)
	{
		/**
		 * @var UploadedFile $image
		 */
		$image = $aData['image'];

		foreach (\Config::get('image') as $key => $value) {
			$file = ImageFile::make($image);

			if (!is_null($value['x']) && !is_null($value['y'])) {
				$file->resize($value['x'], $value['y'], function (Constraint $constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
			}

			$file = $file->encode('jpg', 100);
			$filename = uniqid() . '.jpg';

			$aData[$key . '_url'] = $this->upload->upload($file, $filename);
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
		return false;
	}

	/**
	 * Will be done by deleting the revision
	 * @param \Illuminate\Database\Eloquent\Model $aModel
	 *
	 * @return boolean
	 */
	protected function canDelete(Model $aModel)
	{
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

		if ($user->id == $aModel->revision->user_id || $user->can('edit_foreign_revision')) {
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
		return new ImageModel;
	}
}