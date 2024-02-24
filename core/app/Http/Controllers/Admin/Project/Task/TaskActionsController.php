<?php

namespace App\Http\Controllers\Admin\Project\Task;

use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\Task\ITaskActionItemsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\StoreTaskActionItemsRequest;
use App\Utility\ActivityGenerator;
use Exception;
use Illuminate\Http\JsonResponse;



class TaskActionsController extends Controller
{
    /**
     * @var ITaskRepository
     */
    private $taskActionRepository;
    private $activityRepository;

    /**
     * @param ITaskRepository $taskRepository
     */
    public function __construct(ITaskActionItemsRepository $taskActionRepository, IProjectActivityRepository $activityRepository)
    {
        $this->taskActionRepository = $taskActionRepository;
        $this->activityRepository = $activityRepository;
    }

    public function gets(int $id, $task_id): JsonResponse
    {
        try {
           
            $action_items = $this->taskActionRepository->gets($task_id);
            return response()->json([
                'status' => 200,
                'total' => count($action_items),
                'data' => view('admin.pages.project.task.inc.details._action-lists', [
                    'action_items' => $action_items,
                ])->render()
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 
    
    public function create(int $id, $task_id): JsonResponse
    {
        try {
           
            return response()->json([
                'status' => 200,
                'total' => 0,
                'data' => view('admin.pages.project.task.inc.details._action-list-create', [
                    'comments' => '',
                ])->render()
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    
    public function store($id, $task_id, StoreTaskActionItemsRequest $request): JsonResponse
    {
        try {
           
            $model = $request->validated();
            $this->taskActionRepository->store($model, $task_id);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder saved group of action items. Group name is {$model['action_name']}");
             $this->activityRepository->insert($id, $content, $task_id);
            return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }  
    
    public function rename($id, $task_id): JsonResponse
    {
        try {

           $action_id = request()->input('action_id');
           $action_name = request()->input('action_name');
           $this->taskActionRepository->rename($action_id, $action_name);

             //Insert Activity
             $placeholder = ActivityGenerator::UserNamePlaceHolder;
             $content = ActivityGenerator::getContent("$placeholder renamed group name. new name is $action_name");
             $this->activityRepository->insert($id, $content, $task_id);
            return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 
    
    public function insertItem($id, $task_id): JsonResponse
    {
        try {
           
            $item_name = request()->input('item_name');
            $this->taskActionRepository->insertItem( $task_id, request()->input('action_id'), $item_name);

           //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder inserted an item. that name is $item_name");
           $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    
    public function changeCheckStatus($id, $task_id): JsonResponse
    {
        try {
           $action_id = request()->input('action_id');
           $item_id = request()->input('item_id');
           $is_checked = request()->input('is_checked');

          $this->taskActionRepository->changeCheckStatus($action_id, $item_id , $is_checked);

           //Insert Activity
           $item_name = $this->taskActionRepository->getItemName($item_id);
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder changed '$item_name' status");
           $this->activityRepository->insert($id, $content, $task_id);

            return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }  
    
    public function removeItem($id, $task_id): JsonResponse
    {
        try {
           $action_id = request()->input('action_id');
           $item_id = request()->input('item_id');

           $item_name = $this->taskActionRepository->getItemName($item_id);

          $this->taskActionRepository->removeItem($action_id, $item_id);

           //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder removed '$item_name' ");
           $this->activityRepository->insert($id, $content, $task_id);

          return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 
    
    public function remove($id, $task_id): JsonResponse
    {
        try {
           $action_id = request()->input('action_id');

          $this->taskActionRepository->remove($task_id, $action_id);

           //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder removed group of items");
           $this->activityRepository->insert($id, $content, $task_id);

          return response()->json([
                'status' => 200,
            ]);

        }catch (Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }
    
    public function updateItem($id, $task_id): JsonResponse
    {
        try {
           $action_id = request()->input('action_id');
           $item_id = request()->input('item_id');
           $item_name = request()->input('item_name');

          $this->taskActionRepository->updateItem($action_id, $item_id, $item_name);

           //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder changed item name '$item_name'");
           $this->activityRepository->insert($id, $content, $task_id);

          return response()->json([
                'status' => 200,
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
