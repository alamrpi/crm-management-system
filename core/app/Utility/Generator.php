<?php

namespace App\Utility;

use http\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Generator
{
    public static function taskId(int $project_id){
        $lastTask = DB::table('tasks')
            ->select('tasks.task_id')
            ->orderByDesc('tasks.id')
            ->where('tasks.project_id', $project_id)
            ->first();
        $count = 1;
        if(!empty($lastTask))
        {
            $count = (int)explode('#', $lastTask->task_id)[1];
            $count++;
        }
        return "Task#$count";
    }
    public static function generateAgencyId(): string
    {
        $currentYear = date('Y');
        $last_agency = DB::table('agencies')
            ->whereYear('created_at', '=', date('Y'))
            ->select('agency_id')
            ->orderByDesc('id')
            ->first();
        $count = 1;
        if(!empty($last_agency))
        {
            $count = (int)explode('/', $last_agency->agency_id)[1];
            $count++;
        }
        return "WB/$count/$currentYear";
    }

    public static function generateClientId($prefix = 'C'):string
    {
        $currentYear = date('Y');
        $lastClient = DB::table('clients')
            ->whereYear('created_at', '=', date('Y'))
            ->select('client_id')
            ->orderByDesc('id')
            ->first();
        $count = 1;
        if(!empty($lastClient))
        {
            $count = (int)explode('/', $lastClient->client_id)[1];
            $count++;
        }
        return "$prefix/$count/$currentYear";
    }

    public static function generateStrongPassword(int $length = 8): string
    {
        return Str::random($length);
    }

    public static function generateSlug($text, $model, $ignore_id = null): string
    {
        $slug = strtolower($text);
        $slug = str_replace(array('[\', \']'), '', $slug);
        $slug = preg_replace('/\[.*\]/U', '', $slug);
        $slug = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $slug);
        $slug = htmlentities($slug, ENT_COMPAT, 'utf-8');
        $slug = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $slug );
        $slug = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $slug);

        # slug repeat check
        if($ignore_id != null)
            $model->where('id', '<>', $ignore_id);

        $latest = $model->whereRaw("slug regexp '^{$slug}(-[0-9]+)?$'")
            ->latest('id')
            ->value('slug');

        if($latest){
            $pieces = explode('-', $latest);
            $number = intval(end($pieces));
            $slug .= '-' . ($number + 1);
        }

        return $slug;
    }

    /**
     * Generate Content for activity
     *
     * @param array $titles List of title there each element must bey an associative array (Key is a tag name of HTML and value is content).
     * Ex.
     * ["H1" => '…']
     *
     * @param array $details list of details information. each element shows in paragraph on the view
     *
     * @param array $links list of a link. each element shows as a hyperlink on the view
     * Each element as an associative array
     * Ex: - [['url' => 'url here 1', 'linkText' => 'text here 1'],['url' => 'url here 2', 'linkText' => 'text here 2']]
     *
     * @param array $jsonData list of json data if needed.
     * Ex. ['Json Data Name 1' => 'Json data here', 'Json Data Name 2' => 'Json data here']
     *
     * @return string Generated content as string
     */
    public static function activityContent(array $titles, array $details = [],array $links = [], array $jsonData = []): string
    {
        $contents = '<div>';
        foreach ($titles as $tag => $content){
            $contents .= "<$tag>$content</$tag>";
        }

        //Details concatenate
        foreach ($details as $content){
            $contents .= "<p>$content</p>";
        }

        //Generate links
        foreach ($links as $link){
            $contents .= "<a href='{$link['url']}' target='_blank'>{$link['linkText']}</a>";
        }

        //assign json data
        foreach ($jsonData as $dataKey => $data){
            $contents .= "<p><strong>$dataKey</strong></p><p>{$data}</p>";
        }
        $contents .= '</div>';
        return $contents;
    }
}
