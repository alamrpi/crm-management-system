<?php

namespace App\Http\Controllers\Client;

use App\Data\IRepositories\Projects\IProjectIntegrationKeywordRepository;
use App\Data\IRepositories\Projects\IRankingReportRepository;
use App\Http\Controllers\Controller;
use App\Utility\Client\ClientHelper;
use Illuminate\View\View;

class KeywordRankingReportController extends Controller
{
    private $integrationKeywordRepository;
    private $rankingReportRepository;
    public function __construct(IProjectIntegrationKeywordRepository $integrationKeywordRepository, IRankingReportRepository $rankingReportRepository) {
        $this->integrationKeywordRepository = $integrationKeywordRepository;
        $this->rankingReportRepository = $rankingReportRepository;
    }

    public function index()//: View
    {
        $website = request()->input('website');
        $reporting_date = request()->input('reporting_date');

        if(!empty($reporting_date) && $reporting_date > date('Y-m-d'))
            return redirect()->back()->with('error_msg', 'Future not allowed!');

        $current_project = ClientHelper::getCurrentProject();
        $keywrod_websites = $this->integrationKeywordRepository->gets($current_project['id']);
        if(count($keywrod_websites) == 0)
            $is_any_report = false;
//            return view('client.pages.report.keyword-ranking-report',[
//                'is_any_report' => false,
//            ]);
        if(!empty($website)){
            $website = $keywrod_websites[0]->id;
            $reporting_date = date('Y-m-d');
        }

        $report = $this->getReport($current_project['id'], $website, $reporting_date);
        return view('client.pages.report.keyword-ranking-report',[
            'is_any_report' => !$is_any_report ?? true,
            'current_project' => $current_project,
            'keywrod_websites' => $keywrod_websites,
            'report' => $report
        ]);
    }


    public function keywordDetails()
    {
        try {

            $keyword_id = request()->input('k_id');
            $ig_id = request()->input('ig');
            $result = $this->rankingReportRepository->getKeyworDetails($ig_id, $keyword_id);
           return response()->json([
                 'status' => 200,
                 'dates' => $result['dates'],
                 'positions' => $result['positions'],
                 'related_keywords' => $result['related_keywords']
             ]);

         }catch (\Exception $ex){
             return response()->json([
                 'status' => 500,
                 'message' => 'Something went wrong!',
                 'data' => $ex->getMessage()
             ]);
         }
    }

    private function getReport($project_id, $integration_id, $date) {
        if(!$this->rankingReportRepository->exist($project_id, $integration_id, $date))
        {
            if($date != date('Y-m-d'))
                return null;

            $this->rankingReportRepository->store($project_id, $integration_id, $date);
        }

        return $this->rankingReportRepository->get($project_id, $integration_id, $date);
    }

}
