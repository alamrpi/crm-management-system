<?php

namespace App\Data\IRepositories\Projects;

use Illuminate\Support\Collection;

interface IProjectDocumentRepository
{
    /**
     * Get services by project
     *
     * @param int $project_id
     * @return Collection
     */
    public function gets(int $project_id): Collection;

    public function insert(array $model, $id);

    public function getById($id, $document_id);

    public function update(array $model, $id, $document_id);

    public function delete($id, $document_id);

    public function count($id);
    public function getAllFilesByUserId($userId);
}
