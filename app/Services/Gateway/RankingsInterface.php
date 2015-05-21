<?php
/**
 * Created by PhpStorm.
 * User: itrulia
 * Date: 21.05.15
 * Time: 13:38
 */
namespace TurtleTest\Services\Gateway;

interface RankingsInterface
{
	/**
	 * @param $aCupId
	 * @return array
	 */
	public function getRankings($aCupId);
}