<?php namespace TurtleTest\Services\Fetch;

interface FetchBracketsInterface
{
	/**
	 * @param array $aCups
	 * @return \Illuminate\Support\Collection
	 */
	public function fetchBrakets(array $aCups);
}