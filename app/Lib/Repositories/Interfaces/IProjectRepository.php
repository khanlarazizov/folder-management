<?php

namespace App\Lib\Repositories\Interfaces;

interface IProjectRepository
{
    public function getAllProject($companyId,$data);

    public function getProjectById($companyId, $id);

    public function createProject($companyId, $data);

    public function updateProject($companyId, $data, $id);

    public function deleteProject($companyId, $id);

}
