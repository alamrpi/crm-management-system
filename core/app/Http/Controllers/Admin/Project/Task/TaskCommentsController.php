<?php

namespace App\Http\Controllers\Admin\Project\Task;

use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\Task\ITaskCommentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\SaveCommentRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\ActivityGenerator;
use Exception;
use Illuminate\Http\JsonResponse;


class TaskCommentsController extends Controller
{
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var ITaskCommentsRepository
     */
    private $commentsRepository;
    private $activityRepository;

    /**
     * @param ITaskRepository $taskRepository
     * @param IFileOperationService $fileOperationService
     * @param ITaskCommentsRepository $commentsRepository
     */
    public function __construct(IFileOperationService $fileOperationService, ITaskCommentsRepository $commentsRepository, IProjectActivityRepository $activityRepository)
    {
        $this->fileOperationService = $fileOperationService;
        $this->commentsRepository = $commentsRepository;
        $this->activityRepository = $activityRepository;
    }

    public function gets(int $id, $task_id): JsonResponse
    {
        try {
            $comments = $this->commentsRepository->gets($task_id);
            return response()->json([
                'status' => 200,
                'data' => view('admin.pages.project.task.inc.details._display-comments', [
                    'comments' => $comments
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

    public function store(SaveCommentRequest $request, int $id, $task_id): JsonResponse
    {
        try {
            $infos = [];
            $attachments = $request->file('files');
            if(!empty($attachments)){
                foreach ($attachments as $attachment){
                    $infos[] = $this->fileOperationService->upload($attachment, 'uploads/project/tasks');
                }
            }
            $this->commentsRepository->store($task_id, $request->input('message'), $infos, $request->input('type'));

             //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder posted a comment");
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
