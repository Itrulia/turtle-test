<?php namespace TurtleTest\Http\Controllers;

use TurtleTest\Http\Requests;
use TurtleTest\Repositories\User;
use TurtleTest\User as UserModel;
use TurtleTest\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ResourceController
{
	/**
	 * @var User
	 */
	protected $repository;

	/**
	 * Instantiate a new UserController instance.
	 */
	public function __construct(User $aRepository)
	{
		$this->repository = $aRepository;
		$this->middleware('auth', ['only' => ['update', 'delete']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $aRequest
	 *
	 * @return Response
	 */
	public function index(Request $aRequest)
	{
		/**
		 * @var UserModel $model
		 */
		$model = new UserModel;
		$model = $this->filterBy($model, $aRequest->all());

		return $model->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param RegisterRequest $aRequest
	 *
	 * @return Response
	 */
	public function store(RegisterRequest $aRequest)
	{
		$data = $aRequest->all();

		return $this->repository->create($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param UserModel $aUser
	 *
	 * @return Response
	 * @throws \TurtleTest\Exceptions\UnauthorizedException
	 */
	public function show(UserModel $aUser)
	{
		return $this->repository->show($aUser);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UserModel $aUser
	 * @param RegisterRequest $aRequest
	 *
	 * @return Response
	 */
	public function update(UserModel $aUser, RegisterRequest $aRequest)
	{
		$data = $aRequest->all();

		return $this->repository->update($aUser, $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  UserModel $aUser
	 *
	 * @return Response
	 */
	public function destroy(UserModel $aUser)
	{
		$this->repository->delete($aUser);
	}
}
