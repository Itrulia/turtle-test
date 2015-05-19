<?php namespace TurtleTest\Http\Controllers;

use Parsedown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
	/**
	 * @var Parsedown
	 */
	protected $parser;

	/**
	 * @param Parsedown $aParser
	 */
	public function __construct(Parsedown $aParser)
	{
		$this->parser = $aParser;
	}

	/**
	 * @param Request $aRequest
	 *
	 * @return string
	 */
	public function markdown(Request $aRequest)
	{
		return $this->parser->text($aRequest->get('markdown'));
	}
}
