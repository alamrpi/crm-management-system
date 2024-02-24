<?php

namespace App\Http\Controllers\Admin\Project\Task;

use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\Task\ITaskDetailsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\SaveTaskDetailsRequest;
use App\Utility\ActivityGenerator;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskDetailsController extends Controller
{
    /**
     * @var ITaskRepository
     */
    private $taskRepository;
    private $activityRepository;
    /**
     * @var ITaskDetailsRepository
     */
    private $detailsRepository;

    public function __construct(ITaskRepository $taskRepository, ITaskDetailsRepository $detailsRepository, IProjectActivityRepository $activityRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->activityRepository = $activityRepository;
        $this->detailsRepository = $detailsRepository;
    }

    public function changeLabelName( int $id, $task_id)
    {
        try {
          
            $label_name = request()->input('label_name');
            $this->taskRepository->changeDetailLabel($id, $task_id, request()->input('label_name'));

           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder changed details label name. New name is $label_name");
           $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function store(SaveTaskDetailsRequest $request, int $id, $task_id): JsonResponse
    {
        try {
            $model = $request->validated();
            $details_id = $this->detailsRepository->store($model, $task_id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder added details '{$model['field_name']}'.");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => $this->detailsRepository->get($details_id, $task_id)
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function delete(int $id, $task_id)
    {
        try {

            $this->detailsRepository->delete(request()->input('id'), $task_id);

            $placeholder = ActivityGenerator::UserNamePlaceHolder;
            $content = ActivityGenerator::getContent("$placeholder deleted details");
            $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
}
