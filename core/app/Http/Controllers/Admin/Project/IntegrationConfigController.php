<?php

namespace App\Http\Controllers\Admin\Project;

use App\Data\IRepositories\Projects\IProjectIntegrationKeywordRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IntegrationConfigController extends Controller
{
    private $integrationKeywordRepository;

    public function __construct(IProjectIntegrationKeywordRepository $integrationKeywordRepository) {
        $this->integrationKeywordRepository = $integrationKeywordRepository;
    }
    public function index($id): View
    {
        try {
            return view('admin.pages.project.integration-config.keyword.index', [
                'rows' => $this->integrationKeywordRepository->gets($id)
        ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function store(Request $request, $id)
    {
        try {
            $cid = $this->integrationKeywordRepository->store($id, $request->input('website'));
            return redirect()->route('admin/project/integrationConfig/keyword/keywordWebsite', ['id' => $id, 'cid' => $cid])->with('success_msg', "Integration keyword created successfully!");

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    } 
    
    public function update(Request $request, $id, $cid)
    {
        try {
            $this->integrationKeywordRepository->update($id, $cid, $request->input('website'));
            return redirect()->route('admin/project/integrationConfig/keyword/keywordWebsite', ['id' => $id, 'cid' => $cid])->with('success_msg', "Website save changes!");
        
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    } 
    
    public function updateIdKey(Request $request, $id, $cid)
    {
        try {
            $model = [
                'api_key' => $request->input('api_key'),
                'engine_id' => $request->input('engine_id'),
            ];
            $this->integrationKeywordRepository->updateIdKey($id, $cid, $model);
            return redirect()->back()->with('success_msg', "Id and Api key save changes!");
        
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function keywordWebsite($id, $cid): View
    {
        try {
            return view('admin.pages.project.integration-config.keyword.website', [
                'config' => $this->integrationKeywordRepository->get($id, $cid)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function keywords($id, $cid): View
    {
        try {
            return view('admin.pages.project.integration-config.keyword.keywords', [
                'config' => $this->integrationKeywordRepository->get($id, $cid),
                'keywords' => $this->integrationKeywordRepository->getKeywords($cid)
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }

    public function keywordAddOrUpdate(Request $request, $id, $cid) {
        try {
            $model = [
                'keyword_id' => $request->input('keyword_id'),
                'keyword_name' => $request->input('keyword_name'),
            ];
            $this->integrationKeywordRepository->keywordAddOrUpdate($id, $cid, $model);
            return redirect()->back()->with('success_msg', $model['keyword_id'] == 0 ? 'Keyword has been created' : 'Keyword has been updated');
        
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
    
    public function keywordDelete($id, $cid, $keyword_id) {
        try {
            $this->integrationKeywordRepository->keywordDelete($id, $cid, $keyword_id);
            return redirect()->back()->with('success_msg', 'Keyword has been deleted');
        
        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
    public function keywordIDKey($id, $cid): View
    {
        try {
            return view('admin.pages.project.integration-config.keyword.id-and-key', [
                'config' => $this->integrationKeywordRepository->get($id, $cid),
            ]);

        }catch (\Exception $ex){
            return view('admin.shared.error', [
                'error_msg' => $ex->getMessage()
            ]);
        }
    }
}
