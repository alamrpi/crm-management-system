<?php

namespace App\Data\Repositories\Projects\Task;

use App\Data\IRepositories\Projects\Task\ITaskActionItemsRepository;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;

class TaskActionItemsRepository implements ITaskActionItemsRepository
{
    public function store($model, $task_id)
    {
       $actionId = DB::table('task_actions')->insertGetId([
            'task_id' => $task_id,
            'action_name' => $model['action_name'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $items = [];
        foreach ($model['action_items'] as $action_item) {
            $items[] = [
                'action_id' => $actionId,
                'item_name' => $action_item
            ];
        }

        DB::table('task_action_items')->insert($items);
    }

    public function get(int $id, $task_id)
    {
        return DB::table('task_attachments')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->first();
    }

    public function getItemName(int $item_id){
        return DB::table('task_action_items')->where('id', $item_id)->first()->item_name;
    }

    public function gets(int $task_id): Collection
    {
        return DB::table('task_actions')
            ->join('task_action_items', 'task_action_items.action_id', '=', 'task_actions.id')
            ->where('task_actions.task_id', $task_id)
            ->select('task_actions.*', 'task_action_items.item_name', 'task_action_items.is_checked', 'task_action_items.id as item_id')
            ->get();
    }

    public function delete($id, $task_id)
    {
        DB::table('task_actions')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->delete();
    }

    public function insertItem($task_id, $action_id, $item_name)
    {
        DB::table('task_action_items')->insert([
            'action_id' => $action_id,
            'item_name' => $item_name
        ]);
    } 
    
    public function rename($action_id, $action_name)
    {
        DB::table('task_actions')->where('id', $action_id)->update([
            'action_name' => $action_name
        ]);
    }

    public function changeCheckStatus($action_id, $item_id , $is_checked)
    {
        DB::table('task_action_items')
        ->where('id', $item_id)
        ->where('action_id', $action_id)
        ->update([
            'is_checked' => $is_checked
        ]);
    }

    public function removeItem($action_id, $item_id){
        DB::table('task_action_items')
        ->where('id', $item_id)
        ->where('action_id', $action_id)
        ->delete();
    }

    public function updateItem($action_id, $item_id, $item_name){
        DB::table('task_action_items')
        ->where('id', $item_id)
        ->where('action_id', $action_id)
        ->update([
            'item_name' => $item_name
        ]);
    }

    public function remove($task_id, $action_id){
        DB::table('task_action_items')->where('action_id', $action_id)->delete();
        DB::table('task_actions')->where('task_id', $task_id)->where('id', $action_id)->delete();
    }
}
