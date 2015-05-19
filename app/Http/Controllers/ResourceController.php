<?php namespace TurtleTest\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

abstract class ResourceController extends Controller
{

	/**
	 * @param Model $aModel
	 * @param array $aData
	 *
	 * @return Model
	 */
	protected function filterBy(Model $aModel, array $aData)
	{
		foreach ($aModel->getVisible() as $key) {
			$value = isset($aData[$key]) ? $aData[$key] : null;

			if (!is_null($value)) {
				$aModel = $aModel->where($key, $value);
			}
		}

		return $aModel;
	}
}
