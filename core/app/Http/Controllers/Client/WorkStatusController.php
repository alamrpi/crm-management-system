<?php

namespace App\Http\Controllers\Client;

use App\Constants\Task\CommentType;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\Task\ITaskAssignToRepository;
use App\Data\IRepositories\Projects\Task\ITaskAttachmentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskCommentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Data\IRepositories\Projects\Task\ITaskTimeTrackerRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\SaveCommentRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\ActivityGenerator;
use App\Utility\Client\ClientHelper;

class WorkStatusController extends Controller
{

    private $taskRepository;
    private $assignToRepository;
    private $serviceRepository;
    private $attachmentRepository;
    private $timeTrackerRepository;
    private $activityRepository;
    private $commentsRepository;
    private $fileOperationService;

    public function __construct(ITaskRepository $taskRepository, ITaskAssignToRepository $assignToRepository, IProjectServiceRepository $serviceRepository, 
    ITaskAttachmentsRepository $attachmentRepository, ITaskTimeTrackerRepository $timeTrackerRepository, IProjectActivityRepository $activityRepository, 
    ITaskCommentsRepository $commentsRepository, IFileOperationService $fileOperationService) {

        $this->taskRepository = $taskRepository;
        $this->assignToRepository = $assignToRepository;
        $this->serviceRepository = $serviceRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->timeTrackerRepository = $timeTrackerRepository;
        $this->activityRepository = $activityRepository;
        $this->commentsRepository = $commentsRepository;
        $this->fileOperationService = $fileOperationService;
    }

    public function getTasks()
    {
        try {
            $department_id = request()->input('department_id');
            $current_project = ClientHelper::getCurrentProject();
            $departments = $this->serviceRepository->getDepartments($current_project['id']);
            $selected_dept = !empty($department_id) ? $departments->where('id', $department_id)->first()->name : 'All';
            $main_tasks = $this->taskRepository->getsForClient($current_project['id'], $department_id);
            foreach($main_tasks as $task) {
                $task->assignees = $this->assignToRepository->gets($task->id);
                $sub_tasks = $this->taskRepository->getSubtasks($task->id);
                foreach($sub_tasks as $sub_task){
                    $sub_task->assignees = $this->taskRepository->getSubtasks($sub_task->id);
                }
                $task->sub_tasks = $sub_tasks;
            }

            return response()->json([
                'status' => 200,
                'content' =>  view('client.pages.project.work-status.tasks', [
                    'main_tasks' =>  $main_tasks,
                    'departments' => $departments,
                    'department_id' =>  $department_id,
                    'selected_dept' => $selected_dept
                ])->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 
    
    public function taskDetails($slug, $id)
    {
        try {
            $current_project = ClientHelper::getCurrentProject();

            $task = $this->taskRepository->get($id,  $current_project['id']);
            $task->assignees = $this->assignToRepository->gets($task->id);
            $task->attachments = $this->attachmentRepository->gets($task->id);
            $task->timeTrackers = $this->timeTrackerRepository->getByTask($id);
            $task->activities = $this->activityRepository->getsByTask($current_project['id'], $id);
            return response()->json([
                'status' => 200,
                'content' =>  view('client.pages.project.work-status.task-details-modal', [
                  'task' => $task,

                ])->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 
    
    public function loadComments($slug, $id)
    {
        try {
            $comments = $this->commentsRepository->gets($id);
            return response()->json([
                'status' => 200,
                'data' => view('client.pages.project.work-status.display-comments', [
                    'comments' => $comments
                ])->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    } 


  
    public function storeComments(SaveCommentRequest $request, $slug, $id)
    {
        try {
            $infos = [];
            $attachments = $request->file('files');
            if(!empty($attachments)){
                foreach ($attachments as $attachment){
                    $infos[] = $this->fileOperationService->upload($attachment, 'uploads/project/tasks');
                }
            }
            $this->commentsRepository->store($id, $request->input('message'), $infos, $request->input('type'));

            $current_project = ClientHelper::getCurrentProject();
             //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder posted a comment");
           $this->activityRepository->insert($current_project['id'], $content, $id);

            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }  
    
    public function loadSubmissionComment($slug, $id)
    {
        try {
            $comments = $this->commentsRepository->gets($id, CommentType::SUBMISSION);
            return response()->json([
                'status' => 200,
                'data' => view('client.pages.project.work-status.display-comments', [
                    'comments' => $comments
                ])->render()
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

    public function changeAcceptanceStatus($slug, $id)
    {
        try {
            $this->taskRepository->changeAcceptanceStatus($id, request()->input('status'));
            return response()->json([
                'status' => 200,
                'data' => ''
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!',
                'data' => $ex->getMessage()
            ]);
        }
    }

}
