<?php namespace TurtleTest\Services\Gateway;

interface WinnerInterface
{
	/**
	 * @param $aCupId
	 * @return \TurtleTest\Winner
	 */
	public function getWinner($aCupId);
}