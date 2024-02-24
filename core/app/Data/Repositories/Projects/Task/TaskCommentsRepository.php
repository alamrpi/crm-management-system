<?php

namespace App\Data\Repositories\Projects\Task;

use App\Constants\Task\AcceptedStatus;
use App\Constants\Task\CommentType;
use App\Data\IRepositories\Projects\Task\ITaskCommentsRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskCommentsRepository implements ITaskCommentsRepository
{
    public function store($task_id, $message, $attachment, $type = CommentType::GENERAL)
    {

        if($type == CommentType::REVIEW && !$this->exists($task_id, $type))
        {
            DB::table('tasks')
            ->where('id', $task_id)
            ->update([
                'in_review' => 1,
                'review_time' => date('Y-m-d H:i:s')
            ]);
        }
        
        $id = DB::table('task_comments')->insertGetId([
            'task_id' => $task_id,
            'sender_id' => Auth::id(),
            'message' => $message,
            'type' => $type,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $att = [];
        foreach ($attachment as $file){
            $att[] = [
                'comment_id' => $id,
                'file_name' => $file['original_name'],
                'size' => $file['size'],
                'extension' => $file['ext'],
                'file_path' => $file['path'],
            ];
        }

        DB::table('task_comment_attachments')->insert($att);

        if($type == CommentType::REVIEW && !$this->exists($task_id, $type))
        {
            DB::table('tasks')
            ->where('id', $task_id)
            ->update([
                'in_review' => 1,
                'review_time' => date('Y-m-d H:i:s')
            ]);
        }
    }

    private function exists($task_id, $type) 
    {
        return DB::table('task_comments')->where('task_id', $task_id)->where('type', $type)->exists();
    }

    public function get(int $id, $task_id)
    {
        return DB::table('task_attachments')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->first();
    }

    public function gets($task_id, $type = CommentType::GENERAL): Collection
    {
        $comments = DB::table('task_comments')
            ->join('users', 'task_comments.sender_id', '=', 'users.id')
            ->where('task_comments.task_id', $task_id)
            ->where('task_comments.type', $type)
            ->select('task_comments.*', 'users.photo as sender_photo', 'users.name as sender_name')
            ->get();

        foreach ($comments as $comment)
        {
            $comment->attachments = DB::table('task_comment_attachments')
                ->where('comment_id', $comment->id)
                ->get();
        }

        return $comments;
    }

    public function delete($id, $task_id)
    {
        DB::table('task_attachments')
            ->where('id', $id)
            ->where('task_id', $task_id)
            ->delete();

    }
}
