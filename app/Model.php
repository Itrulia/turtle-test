<?php namespace TurtleTest;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use LogicException;

abstract class Model implements Arrayable, Jsonable
{
	/**
	 * @var array
	 */
	protected $data = [];


	/**
	 * @param string $aKey
	 *
	 * @return mixed
	 */
	public function __get($aKey)
	{
		return $this->get($aKey);
	}

	/**
	 * @param string $aKey
	 * @param mixed  $aValue
	 */
	public function __set($aKey, $aValue)
	{
		$this->set($aKey, $aValue);
	}

	/**
	 * @param $aKey
	 * @param $aArgs
	 *
	 * @throws \LogicException
	 * @return mixed
	 */
	public function __call($aKey, $aArgs)
	{
		if (substr($aKey, 0, 3) == "get") {
			$key = strtolower(substr($aKey, 3));

			return $this->get($key);
		} elseif (substr($aKey, 0, 3) == "set") {
			$key = strtolower(substr($aKey, 3));
			$this->set($key, $aArgs[0]);

			return null;
		}

		throw new LogicException;
	}

	/**
	 * @param $aKey
	 *
	 * @return bool
	 */
	protected function hasGetter($aKey)
	{
		return method_exists($this, 'get' . studly_case($aKey) . 'Attribute');
	}

	/**
	 * @param $aKey
	 *
	 * @return bool
	 */
	protected function hasSetter($aKey)
	{
		return method_exists($this, 'set' . studly_case($aKey) . 'Attribute');
	}

	/**
	 * @param $aKey
	 *
	 * @return mixed
	 */
	protected function getAttribute($aKey)
	{
		return $this->{'get' . studly_case($aKey) . 'Attribute'}();
	}

	/**
	 * @param $aKey
	 * @param $aValue
	 *
	 * @return mixed
	 */
	protected function setAttribute($aKey, $aValue)
	{
		$method = 'set' . studly_case($aKey) . 'Attribute';

		return $this->{$method}($aValue);
	}

	/**
	 * @param string $aKey
	 * @param mixed  $aValue
	 */
	protected function set($aKey, $aValue)
	{
		if ($this->hasSetter($aKey)) {
			$this->setAttribute($aKey, $aValue);
		} else {
			$this->data[$aKey] = $aValue;
		}
	}

	/**
	 * @param $aKey
	 *
	 * @return mixed
	 */
	protected function get($aKey)
	{
		if ($this->hasGetter($aKey)) {
			return $this->getAttribute($aKey);
		}

		if (array_key_exists($aKey, $this->data)) {
			return $this->data[$aKey];
		} else {
			return null;
		}
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$array = [];

		foreach($this->data as $key => $data) {
			if ($data instanceof Arrayable) {
				$data = $data->toArray();
			}

			$array[$key] = $data;
		}

		return $array;
	}

	/**
	 * Convert the object to its JSON representation.
	 *
	 * @param  int $options
	 * @return string
	 */
	public function toJson($options = 0)
	{
		return json_encode($this->toArray(), $options);
	}
}