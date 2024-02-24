<?php

namespace App\Http\Controllers\Admin\Project;

use App\Constants\DocumentType;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Data\Repositories\Projects\ProjectActivityRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\SaveProjectDocumentRequest;
use App\Services\Interfaces\IFileOperationService;
use App\Utility\ActivityGenerator;
use App\Utility\Generator;
use App\Utility\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectDocumentController extends Controller
{
    /**
     * @var IProjectDocumentRepository
     */
    private $projectDocumentRepository;
    /**
     * @var IFileOperationService
     */
    private $fileOperationService;
    /**
     * @var ProjectActivityRepository
     */
    private $activityRepository;

    public function __construct(IProjectDocumentRepository $projectDocumentRepository, IFileOperationService $fileOperationService, ProjectActivityRepository $activityRepository)
    {

        $this->projectDocumentRepository = $projectDocumentRepository;
        $this->fileOperationService = $fileOperationService;
        $this->activityRepository = $activityRepository;
    }
    public  function index($id): View
    {
        try {
            return view('admin.pages.project.document.index', [
                'rows' => $this->projectDocumentRepository->gets($id)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function create($id): View
    {
        return view('admin.pages.project.document.create');
    }

    public  function store(SaveProjectDocumentRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $model = $request->validated();
            $model['created_by'] = Auth::id();

            $fileInfo = [];
            if(!empty($model['file']))
            {
                $fileInfo = $this->fileOperationService->upload($model['file'],"uploads/project/document");
                $model['file_path'] = $fileInfo['path'];
                $model['size'] = $fileInfo['size'];
                $model['file_type'] = $fileInfo['ext'];
            }else{
                $model['file_path'] = null;
                $model['size'] = null;
                $model['file_type'] = null;
            }
            $this->projectDocumentRepository->insert($model, $id);

            //Add activity
            $content = ActivityGenerator::uploadFile($fileInfo, 'document');
            $this->activityRepository->insert($id, $content);
            DB::commit();
            return redirect()->route('admin/project/document/index', ['id' => $id])->with('success_msg', "Document has been created successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function edit($id, $document_id): View
    {
        DB::beginTransaction();
        try {
            return view('admin.pages.project.document.edit', [
                'document' => $this->projectDocumentRepository->getById($id, $document_id)
            ]);
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function update(SaveProjectDocumentRequest $request, $id, $document_id)
    {
        DB::beginTransaction();
        try {

            $document = $this->projectDocumentRepository->getById($id, $document_id);
            if($document == null)
                return view('admin.shared.error');

            $model = $request->validated();
            if(!empty($model['file']))
            {
                $fileInfo = $this->fileOperationService->upload($model['file'],"uploads/project/document");
                $model['file_path'] = json_encode($fileInfo);
                $model['size'] = $fileInfo['size'];
                $model['file_type'] = $fileInfo['ext'];
            }else{
                $model['file_path'] = $document->file_path;
                $model['size'] = $document->size;
                $model['file_type'] =$document->file_type;
            }
            $this->projectDocumentRepository->update($model, $id, $document_id);

            //Add activity
            $contentData = [
                'New Data' => $this->processNewInformation($model),
                'Old Data' => $this->processOldInformation($document)
            ];
            $title = ActivityGenerator::UserNamePlaceHolder ." updated a document";
            $content = ActivityGenerator::getContent($title, $contentData);
            $this->activityRepository->insert($id, $content);

            DB::commit();
            return redirect()->route('admin/project/document/index', ['id' => $id])->with('success_msg', "Document has been updated successfully");
        }catch (\Exception $ex){
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public  function delete($id, $document_id)
    {
        DB::beginTransaction();
        try {

            $document = $this->projectDocumentRepository->getById($id, $document_id);
            if ($document == null)
                return redirect()->back()->with('error_msg', "Invalid request");

            $this->projectDocumentRepository->delete($id, $document_id);
            $this->fileOperationService->delete($document->file_path);
            $activityContent = ActivityGenerator::deleteFile(basename($document->file_path), 'document');
            $this->activityRepository->insert($id, $activityContent);
            DB::commit();
            return redirect()->route('admin/project/document/index', ['id' => $id])->with('success_msg', "Document has been deleted successfully");
        } catch (\Exception $ex) {
            DB::rollBack();
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    private function processOldInformation($info): array
    {
        $fileInfo = json_decode($info->file_path);
        if($fileInfo == null )
            return [];
        return [
            $info->document_name,
            DocumentType::ConvertNumberToText($info->type),
            $fileInfo->original_name
        ];
    }

    private function processNewInformation($info): array
    {
        $infos = [
            $info['document_name'],
            DocumentType::ConvertNumberToText($info['type'])
        ];
        return array_merge($infos, ActivityGenerator::generateFileContent((array)json_decode($info['file_path'])));
    }
}
