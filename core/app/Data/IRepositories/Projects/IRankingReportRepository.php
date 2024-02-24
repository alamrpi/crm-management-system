<?php

namespace App\Data\IRepositories\Projects;

interface IRankingReportRepository
{
    public function store($project_id, $integration_id, $date): int;
    public function exist($project_id, $integration_id, $date): bool;
    public function get($project_id, $integration_id, $date);
    public function getKeyworDetails($ig_id, $keyword_id);
}
