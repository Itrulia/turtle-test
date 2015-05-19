<?php namespace TurtleTest\Http\Controllers;

use TurtleTest\User;
use Parsedown;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller
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
	 * @param Guard $aGuard
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function authenticate(Request $aRequest, Guard $aGuard)
	{
		$credentials = $aRequest->only('email', 'password');
		$token = JWTAuth::attempt($credentials);

		if (!$token) {
			$errors = [];
			$user = User::whereEmail($credentials['email'])->count();

			$errors['password'] = 'The password is invalid';

			if ($user === 0) {
				$errors['email'] = 'The email address does not exists';
			}

			return response($errors, 422);
		}

		return response()->json($aGuard->user());
	}
}
