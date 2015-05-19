<?php namespace TurtleTest\Http\Controllers;

use TurtleTest\Http\Requests;
use TurtleTest\Repositories\Revision;
use TurtleTest\Repositories\Image;
use TurtleTest\Revision as RevisionModel;
use Illuminate\Http\Response;
use TurtleTest\Http\Requests\StoreRevisionRequest;
use Illuminate\Http\Request;

class RevisionController extends ResourceController
{
	/**
	 * @var Revision
	 */
	protected $repository;

	/**
	 * Instantiate a new RevisionController instance.
	 *
	 * @param Revision $aRepository
	 */
	public function __construct(Revision $aRepository)
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
		 * @var RevisionModel $model
		 */
		$model = new RevisionModel;
		$model = $this->filterBy($model, $aRequest->all());

		return $model->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreRevisionRequest $aRequest
	 *
	 * @param Image $aImageRepository
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function store(StoreRevisionRequest $aRequest, Image $aImageRepository)
	{
		$data = $aRequest->all();
		$data['image'] = $aImageRepository->create(['image' => $data['image']]);

		/**
		 * @var RevisionModel $revision
		 */
		try {
			$revision = $this->repository->create($data);
		} catch (\Exception $e) {
			$data['image']->delete();
			throw $e;
		}

		return $revision;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param RevisionModel $aRevision
	 *
	 * @return Response
	 * @throws \TurtleTest\Exceptions\UnauthorizedException
	 */
	public function show(RevisionModel $aRevision)
	{
		return $this->repository->show($aRevision);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param RevisionModel $aRevision
	 * @param StoreRevisionRequest $aRequest
	 *
	 * @return Response
	 */
	public function update(RevisionModel $aRevision, StoreRevisionRequest $aRequest)
	{
		$data = $aRequest->all();

		return $this->repository->update($aRevision, $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  RevisionModel $aRevision
	 *
	 * @return Response
	 */
	public function destroy(RevisionModel $aRevision)
	{
		$this->repository->delete($aRevision);
	}
}
