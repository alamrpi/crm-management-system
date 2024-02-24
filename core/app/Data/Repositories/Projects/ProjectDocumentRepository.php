<?php

namespace App\Data\Repositories\Projects;

use App\Constants\DocumentType;
use App\Constants\EmployeeTypes;
use App\Constants\PurchaseType;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Utility\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProjectDocumentRepository implements IProjectDocumentRepository
{
    /**
     * Get services by project
     *
     * @param int $project_id
     * @return Collection
     */
    public function gets(int $project_id): Collection
    {
        $type = request()->input('type');

        $query = DB::table('project_documents')
            ->join('users', 'project_documents.created_by', '=', 'users.id')
            ->where('project_documents.project_id', '=', $project_id)
            ->orderBy('project_documents.id')
            ->select('project_documents.*', 'users.name as create_document_by');

        if(!empty($type))
            $query->where('type', $type);

        return $query->get();
    }

    public function insert(array $model, $id)
    {
        return DB::table('project_documents')->insertGetId([
            'project_id' => $id,
            'document_name' => $model['document_name'],
            'type' => $model['type'],
            'file_type' => $model['file_type'],
            'size' => $model['size'],
            'file_path' => $model['file_path'],
            'file_link' => $model['file_link'],
            'created_by' => $model['created_by'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getById($id, $document_id)
    {
        return DB::table('project_documents')
            ->where('project_documents.project_id', '=', $id)
            ->where('project_documents.id', '=', $document_id)
            ->first();
    }

    public function update(array $model, $id, $document_id)
    {
        DB::table('project_documents')->where('id', $document_id)->update([
            'document_name' => $model['document_name'],
            'type' => $model['type'],
            'file_type' => $model['file_type'],
            'size' => $model['size'],
            'file_path' => $model['file_path'],
            'file_link' => $model['file_link'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function delete($id, $document_id)
    {
        DB::table('project_documents')->where('id', $document_id)->where('project_id', $id)->delete();
    }

    public function count($id)
    {
        $documents = DB::table('project_documents')
            ->where('project_id', $id)
            ->select('project_documents.type')
            ->get();

        return [
            'total' => count($documents),
            'project' => count($documents->where('type', DocumentType::PROJECT)),
            'research' => count($documents->where('type', DocumentType::RESEARCH)),
        ];
    }

    public function getAllFilesByUserId($userId)
    {
        $collection = new Collection();
        $project_documents = DB::table('project_documents')
            ->where('created_by', '=', $userId)
            ->orderBy('id', 'desc')
            ->select('id','created_by as user', 'document_name as name', 'file_path as path', 'file_type as type', 'size as size', 'created_at' )
            ->get();

        $task_attachments = DB::table('task_attachments')
            ->where('created_by', '=', $userId)
            ->orderBy('id', 'desc')
            ->select('id','created_by as user', 'attachment_name as name', 'path as path', 'extension as type', 'size as size', 'created_at' )
            ->get();

        return $collection = $collection->merge($project_documents)->merge($task_attachments);

//        $task_comment_attachments = DB::table('task_comment_attachments')
//            ->where('created_by', '=', $userId)
//            ->orderBy('id', 'desc')
//            ->select('created_by as user', 'file_name as name', 'file_path as path', 'extension as type', 'size as size', 'created_at' );

    }
}
