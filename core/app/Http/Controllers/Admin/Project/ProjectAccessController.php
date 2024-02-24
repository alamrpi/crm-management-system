<?php

namespace App\Http\Controllers\Admin\Project;

use App\Data\IRepositories\Projects\IProjectAccessRepository;
use App\Data\IRepositories\Projects\IProjectAccessRequestRepository;
use App\Data\Repositories\Projects\ProjectActivityRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\SaveProjectAccessReqRequest;
use App\Http\Requests\Admin\Project\SaveProjectAccesssRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\ActivityGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectAccessController extends Controller
{
    /**
     * @var IProjectAccessRepository
     */
    private $projectAccessRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var IProjectAccessRequestRepository
     */
    private $accessRequestRepository;
    /**
     * @var ProjectActivityRepository
     */
    private $activityRepository;

    /**
     * @param IProjectAccessRepository $projectAccessRepository
     * @param IFileOperationService $fileOperationService
     * @param IProjectAccessRequestRepository $accessRequestRepository
     * @param ProjectActivityRepository $activityRepository
     */
    public function __construct(IProjectAccessRepository $projectAccessRepository, IFileOperationService $fileOperationService, IProjectAccessRequestRepository $accessRequestRepository, ProjectActivityRepository $activityRepository)
    {
        $this->projectAccessRepository = $projectAccessRepository;
        $this->fileOperationService = $fileOperationService;
        $this->accessRequestRepository = $accessRequestRepository;
        $this->activityRepository = $activityRepository;
    }

    public  function index($id): View
    {
        try {
            return view('admin.pages.project.access.index', [
                'rows' => $this->projectAccessRepository->gets($id),
                'access_requests' => $this->accessRequestRepository->getsForDdl($id),
                'request_rows' => $this->accessRequestRepository->gets($id)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function store(SaveProjectAccesssRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $model = $request->validated();

            if(!empty($model['file']))
            {
                $fileInfo = $this->fileOperationService->upload($model['file'],"uploads/project/access/icon");
                $model['file_info'] = json_encode($fileInfo);
            }else{
                $model['file_info'] = null;
            }

            $this->projectAccessRepository->store($model, $id);

            //Activity added
            $title = ActivityGenerator::UserNamePlaceHolder ." added an access \"{$model['access_title']}\"";
            $content = ActivityGenerator::getContent($title, $model['file_info'] != null ? [ActivityGenerator::generateFileContent((array)json_decode($model['file_info']))] : []);
            $this->activityRepository->insert($id, $content);
            DB::commit();
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function edit($id, $access_id): View
    {
        DB::beginTransaction();
        try {

            $access = $this->projectAccessRepository->getById($id, $access_id);
            $rows = $this->projectAccessRepository->gets($id);

            return view('admin.pages.project.access.index', [
                'access' => $access,
                'rows' => $rows,
                'access_requests' => $this->accessRequestRepository->getsForDdl($id, $access_id),
                'request_rows' => $this->accessRequestRepository->gets($id)
            ]);
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function update(SaveProjectAccesssRequest $request, $id, $access_id)
    {
        DB::beginTransaction();
        try {

            $access = $this->projectAccessRepository->getById($id, $access_id);
            if($access == null)
                return redirect()->back()->with('error_msg', "Invalid request");
            $model = $request->validated();
            if(!empty($model['file']))
            {
                $fileInfo = $this->fileOperationService->upload($model['file'],"uploads/project/access");
                $model['file_info'] = json_encode($fileInfo);
            }else{
                $model['file_info'] = $access->file_info;

            }
            $this->projectAccessRepository->update($model, $id, $access_id);

            //Activity added
            $title = ActivityGenerator::UserNamePlaceHolder ." updated an access \"{$model['access_title']}\"";
            $oldData = [$access->access_title];
            if($access->file_info != null)
                $oldData[] = json_decode($access->file_info)->original_name;

            $contentData = [
                "Old Data" => $oldData,
                "New Data" => ActivityGenerator::generateFileContent((array)json_decode($model['file_info'])),
            ];
            $this->activityRepository->insert($id, ActivityGenerator::getContent($title, $contentData));

            DB::commit();
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access has been updated successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
    public  function delete($id, $access_id)
    {

        DB::beginTransaction();
        try {

            $access = $this->projectAccessRepository->getById($id, $access_id);

            if ($access == null)
                return redirect()->back()->with('error_msg', "Invalid request");

            if($access->file_info != null){
                $file_info = json_decode($access->file_info);
                $this->fileOperationService->delete($file_info->path);
            }

            $this->projectAccessRepository->delete($id, $access_id);
            //Activity added
            $title = ActivityGenerator::UserNamePlaceHolder ." deleted an access \"{$access->access_title}\"";
            $oldData = [];
            if($access->file_info != null)
                $oldData = [json_decode($access->file_info)->original_name];

            $contentData = [
                "Old Data" => $oldData,
            ];
            $this->activityRepository->insert($id, ActivityGenerator::getContent($title, $contentData));
            DB::commit();
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access has been deleted successfully");
        } catch (\Exception $ex) {
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function requestStore(SaveProjectAccessReqRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $this->accessRequestRepository->store($request->validated(), $id);
            //Activity added
            $title = ActivityGenerator::UserNamePlaceHolder ." created an access request \"{$request->input('request_title')}\"";
            $this->activityRepository->insert($id, ActivityGenerator::getContent($title));
            DB::commit();
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access request has been created");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function requestUpdate(SaveProjectAccessReqRequest $request, $id, $request_id)
    {
        DB::beginTransaction();

        try {
            $access_request = $this->accessRequestRepository->getById($id,$request_id);
            if($access_request == null)
                return view('admin.shared.404');

            $this->accessRequestRepository->update($request->validated(), $id, $request_id);
            DB::commit();
            //Activity added
            $title = ActivityGenerator::UserNamePlaceHolder ." updated an access request \"{$request->input('request_title')}\"";
            $this->activityRepository->insert($id, ActivityGenerator::getContent($title, [
                'Old Info' => [$access_request->request_title]
            ]));
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access request has been updated");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function requestDelete($id, $request_id)
    {
        DB::beginTransaction();

        try {
            $access_request = $this->accessRequestRepository->getById($id,$request_id);
            if($access_request == null)
                return view('admin.shared.404');
            $this->accessRequestRepository->delete($id, $request_id);
            DB::commit();
            $title = ActivityGenerator::UserNamePlaceHolder ." deleted an access request \"{$access_request->request_title}\"";
            $this->activityRepository->insert($id, ActivityGenerator::getContent($title));
            return redirect()->route('admin/project/access/index', ['id' => $id])->with('success_msg', "Access request has been deleted");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}
