<?php

namespace App\Http\Controllers\Admin\Project\Task;

use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\Task\ITaskAttachmentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\Task\SaveAttachmentsRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\ActivityGenerator;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class TaskAttachmentsController extends Controller
{
    /**
     * @var ITaskAttachmentsRepository
     */
    private $attachmentsRepository;
    private $activityRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;

    public function __construct(ITaskAttachmentsRepository $attachmentsRepository, IFileOperationService $fileOperationService, IProjectActivityRepository $activityRepository)
    {
        $this->attachmentsRepository = $attachmentsRepository;
        $this->activityRepository = $activityRepository;
        $this->fileOperationService = $fileOperationService;
    }

    public function gets(int $id, $task_id): JsonResponse
    {
        try {
            $attachments = $this->attachmentsRepository->gets($task_id);
            return response()->json([
                'status' => 200,
                'total' => count($attachments),
                'data' => view('admin.pages.project.task.inc.details._attachment-list', [
                    'attachments' => $attachments
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

    public function store(SaveAttachmentsRequest $request, int $id, $task_id): JsonResponse
    {
        try {
            $attachments = $request->file('files');
            $infos = [];
            foreach ($attachments as $attachment){

                $infos[] = $this->fileOperationService->upload($attachment, 'uploads/project/tasks');
            }

            $files = [];
            foreach ($infos as $info){
                $files[] = [
                    'task_id' => $task_id,
                    'attachment_name' => $info['original_name'],
                    'extension' => $info['ext'],
                    'size' => $info['size'],
                    'path' => $info['path'],
                    'created_by' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            $this->attachmentsRepository->store($files);

            //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder upload task attachments");
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

    public function delete(int $id, $task_id)
    {
        try {
            $attachment_id = request()->input('id');
            $attachment = $this->attachmentsRepository->get($attachment_id, $task_id);
            if(empty($attachment))
                return response()->json([
                    'status' => 400,
                    'data' => 'Attachment not found!'
                ]);

            $this->attachmentsRepository->delete(request()->input('id'), $task_id);
            
            //Insert Activity
           $placeholder = ActivityGenerator::UserNamePlaceHolder;
           $content = ActivityGenerator::getContent("$placeholder deleted task");
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
