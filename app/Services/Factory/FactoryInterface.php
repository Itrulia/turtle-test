<?php
/**
 * Created by PhpStorm.
 * User: itrulia
 * Date: 21.05.15
 * Time: 13:37
 */
namespace TurtleTest\Services\Factory;

interface FactoryInterface
{
	/**
	 * @param array $aData
	 * @return \TurtleTest\Model
	 */
	public function create(array $aData);

	/**
	 * @param array $aData
	 * @return array
	 */
	public function createMany(array $aData);
}