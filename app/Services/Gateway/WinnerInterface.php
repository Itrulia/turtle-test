<?php
/**
 * Created by PhpStorm.
 * User: itrulia
 * Date: 21.05.15
 * Time: 13:39
 */
namespace TurtleTest\Services\Gateway;

interface WinnerInterface
{
	/**
	 * @param $aCupId
	 * @return \TurtleTest\Model|null
	 */
	public function getWinner($aCupId);
}