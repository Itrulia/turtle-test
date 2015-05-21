<?php namespace TurtleTest\Services\Gateway;

interface RankingsInterface
{
	/**
	 * @param $aCupId
	 * @return array
	 */
	public function getRankings($aCupId);
}