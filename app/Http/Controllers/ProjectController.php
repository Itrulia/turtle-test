<?php namespace TurtleTest\Http\Controllers;

use TurtleTest\Http\Requests;
use TurtleTest\Repositories\Project;
use TurtleTest\Project as ProjectModel;
use TurtleTest\Http\Requests\StoreProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends ResourceController
{
	/**
	 * @var Project
	 */
	protected $repository;

	/**
	 * Instantiate a new ProjectController instance.
	 *
	 * @param Project $aRepository
	 */
	public function __construct(Project $aRepository)
	{
		$this->repository = $aRepository;
		$this->middleware('auth', ['only' => ['store', 'update', 'delete']]);
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
		 * @var ProjectModel $model
		 */
		$model = new ProjectModel;
		$model = $this->filterBy($model, $aRequest->all());
		$model = $model->visible();

		return $model->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreProjectRequest $aRequest
	 *
	 * @return Response
	 */
	public function store(StoreProjectRequest $aRequest)
	{
		$data = $aRequest->all();

		return $this->repository->create($data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param ProjectModel $aProject
	 *
	 * @return Response
	 * @throws \TurtleTest\Exceptions\UnauthorizedException
	 */
	public function show(ProjectModel $aProject)
	{
		return $this->repository->show($aProject);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param ProjectModel $aProject
	 * @param StoreProjectRequest $aRequest
	 *
	 * @return Response
	 */
	public function update(ProjectModel $aProject, StoreProjectRequest $aRequest)
	{
		$data = $aRequest->all();

		return $this->repository->update($aProject, $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  ProjectModel $aProject
	 *
	 * @return Response
	 */
	public function destroy(ProjectModel $aProject)
	{
		$this->repository->delete($aProject);
	}
}
