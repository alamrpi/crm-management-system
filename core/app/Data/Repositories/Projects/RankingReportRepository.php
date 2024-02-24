<?php

namespace App\Data\Repositories\Projects;

use App\Data\IRepositories\Projects\IRankingReportRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RankingReportRepository implements IRankingReportRepository
{
    public function store($project_id, $integration_id, $date):int
    {
        $api_auth = $this->getApiAuthentication($project_id, $integration_id);
        $report_id = DB::table('ranking_reports')->insertGetId([
            'project_id' => $project_id,
            'intregration_keyword_id' => $integration_id,
            'ranking_percentage' => 0,
            'reported_date' => $date
        ]);
        $keywords = $this->getKeywords($integration_id);
        $results = [];
        foreach($keywords as $keyword){
            $position = 0;
            $results = array_merge($results,$this->callApi($api_auth, $keyword->keyword_name, $position));
            $keyword_id = DB::table('ranking_report_keywords')->insertGetId([
                'ranking_report_id' => $report_id,
                'keyword_name' => $keyword->keyword_name,
                'position' =>  $position
            ]);

            //store related keywords
            $this->storeRelatedKeyword($keyword_id, $keyword->keyword_name);
        }

        $competitors = collect($results)->groupBy('displayLink')->map(function ($group, $i) use($report_id) {
            return [
                'ranking_report_id' => $report_id,
                'competitor_name' => $i,
                'common_keyword' => $group->count()
            ];
        })->sortByDesc('common_keyword')->take(10)->toArray();

        DB::table('ranking_report_competitors')->insert($competitors);

        return $report_id;
    }
    public function exist($project_id, $integration_id, $date):bool
    {
        return DB::table('ranking_reports')->where('project_id', $project_id)
        ->where('intregration_keyword_id', $integration_id)
        ->whereDate('reported_date', $date)
        ->exists();
    }
    public function get($project_id, $integration_id, $date)
    {
        $report = DB::table('ranking_reports')->where('project_id', $project_id)
        ->where('intregration_keyword_id', $integration_id)
        ->whereDate('reported_date', $date)
        ->first();

        $prevDate = Carbon::parse($date)->subDay();

        $prev_report = DB::table('ranking_reports')->where('project_id', $project_id)
        ->where('intregration_keyword_id', $integration_id)
        ->whereDate('reported_date', $prevDate->toDateString())
        ->first();

        $keywords_query = DB::table('ranking_report_keywords')
        ->where('ranking_report_id', $report->id)
        ->select('ranking_report_keywords.id', 'ranking_report_keywords.keyword_name', 'ranking_report_keywords.position');

        $top_keywords_query = clone $keywords_query;
        if(empty($prev_report)){
            $keywords_query->addSelect(DB::raw('0 as prev_position'));
        }else{
            $keywords_query->addSelect(DB::raw("(SELECT rrk.position FROM ranking_report_keywords AS rrk WHERE rrk.ranking_report_id = '{$prev_report->id}' AND rrk.keyword_name = ranking_report_keywords.keyword_name LIMIT 1) as prev_position"));
        }

        $keywords = $keywords_query->get();
        $report->keywords = $keywords;
        $report->top_keywords =  $top_keywords_query->orderBy('position')->limit(10)->get();

        $rankingKeywordCount = count($keywords->where('position', '>', 0));
        if($rankingKeywordCount > 0){
            $report->ranking_percent = ($rankingKeywordCount * 100) / count($keywords);
        }else{
            $report->ranking_percent = 0;   
        }

        $report->competitors = DB::table('ranking_report_competitors')
        ->where('ranking_report_id', $report->id)
        ->select('competitor_name', 'common_keyword')
        ->get();

        $report->related_keywords = DB::table('ranking_report_related_keywords')
        ->join('ranking_report_keywords', 'ranking_report_related_keywords.ranking_report_keyword_id', '=', 'ranking_report_keywords.id')
        ->where('ranking_report_keywords.ranking_report_id', $report->id)
        ->select('ranking_report_related_keywords.keyword_name', 'ranking_report_related_keywords.position')
        ->get();

        return $report;
    }

    public function getKeyworDetails($ig_id, $keyword_id)
    {
        $keyword = DB::table('ranking_report_keywords')
        ->where('id', $keyword_id)
        ->first();

        $month = date('m');
        $keywords = DB::table('ranking_report_keywords')
        ->join('ranking_reports', 'ranking_report_keywords.ranking_report_id', '=', 'ranking_reports.id')
        ->where('ranking_report_keywords.keyword_name', $keyword->keyword_name)
        ->where('ranking_reports.intregration_keyword_id', $ig_id)
        ->whereMonth('ranking_reports.reported_date', $month)
        ->whereYear('ranking_reports.reported_date', date('y'))
        ->select('ranking_report_keywords.position', DB::raw('(DAY(ranking_reports.reported_date)) as day'))
        ->get();

        return [
            'positions' => $keywords->pluck('position')->toArray(),
            'dates' => $keywords->pluck('day')->toArray(),
            'related_keywords' => DB::table('ranking_report_related_keywords')
            ->where('ranking_report_keyword_id', $keyword_id)
            ->get()
        ];
    }
    
    private function storeRelatedKeyword($keyword_id, $keyword_name){

        $google_api = env('RELATED_KEYWORD_API').'&q='.urlencode($keyword_name);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $google_api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
     
        $xml = simplexml_load_string($result);
        $keywords = [];    
        $suggestions = [];
        foreach ($xml->CompleteSuggestion as $suggestion) {
            $data_attribute = $suggestion->suggestion->attributes()->data;
            $suggestions[] = (string) $data_attribute;
        }

        foreach ($suggestions as $suggestion) {
            $keywords[] = [
                'ranking_report_keyword_id' => $keyword_id,
                'keyword_name' => $suggestion,
                'position' => 0,
            ];
        }
        DB::table('ranking_report_related_keywords')->insert($keywords);
    }

    private function getApiAuthentication($project_id, $integration_id){
        return DB::table('integration_keywords')
        ->where('project_id', $project_id)
        ->where('id', $integration_id)
        ->select('engine_id', 'api_key', 'website')
        ->first();
    }

    private function getKeywords($integration_id){
        return DB::table('integration_keyword_keywords')
        ->where('integration_keyword_id', $integration_id)
        ->select('id', 'keyword_name')
        ->get();
    }

    private function callApi($api_auth, $keyword_name, &$position) 
    {
        $base_api_endpoint = env('RANKING_REPORT_API_ENDPOINT')."?key={$api_auth->api_key}&cx={$api_auth->engine_id}&q=$keyword_name&num=10";
        $limit = env('NUMBER_OF_DATA_FETCH');
        $last_count = 1;
        $search_results = [];
        while($limit >  $last_count){
            $response = $this->sentRequest("$base_api_endpoint&start=$last_count");
            if(!empty($response)){
                $items = $response['items'];
                foreach($items as $item)
                {
                    $title = '';
                    $meta_tags = $item['pagemap']['metatags'][0];
                    if(array_key_exists('og:site_name', $meta_tags))
                        $title = $meta_tags['og:site_name'];
                    else if(array_key_exists('og:title', $meta_tags))
                        $title = $meta_tags['og:title'];
                    else if(array_key_exists('title', $item))
                        $title = $item['title'];
    
                    $search_results[] = [
                        'displayLink' => $item['displayLink'],
                        'title' => $title
                    ];
    
                    if($api_auth->website == $item['displayLink'])
                        $position = count($search_results);
                }
               
                if(count($items) == 10)
                    $last_count += 10; 
                else
                    break; 
            }else{
                break;
            }    
        }

        return $search_results;
    }

    private function sentRequest($url){
        $headers = array(
            'Content-Type: application/json'
        );
          // Create a cURL handle to make the API request
          $ch = curl_init($url);
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
          curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch,CURLOPT_ENCODING,'');
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        //   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
          // Send the API request and get the response
          $response = curl_exec($ch);
  
          // Check for errors
          if (curl_errno($ch)) {
              return curl_error($ch);
          }
  
          // Close the cURL handle
          curl_close($ch);
  
          if (empty($response)){
              return false;
          }
  
          // Parse the response and output the generated text
          return json_decode($response, true);
    }

}
