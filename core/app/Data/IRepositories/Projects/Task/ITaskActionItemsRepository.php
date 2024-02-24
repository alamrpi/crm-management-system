<?php

namespace App\Data\IRepositories\Projects\Task;

use Illuminate\Support\Collection;

interface ITaskActionItemsRepository
{
    public function updateItem($action_id, $item_id, $item_name);
    public function removeItem($action_id, $item_id);
    public function remove($task_id, $action_id);
    public function changeCheckStatus($action_id, $item_id , $is_checked);
    public function insertItem($task_id, $action_id, $item_name);
    public function rename($action_id, $action_name);
    public function store($model, $task_id);
    public function get(int $id, $task_id);
    public function getItemName(int $item_id);
    public function gets(int $task_id): Collection;
    public function delete($id, $task_id);
}
