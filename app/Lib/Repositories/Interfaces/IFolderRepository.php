<?php

namespace App\Lib\Repositories\Interfaces;

interface IFolderRepository
{
    public function getAllFolders($companyId, $projectId,$data);

    public function getFolderById($companyId, $projectId, $id);

    public function createFolder($companyId, $projectId, $data);

    public function updateFolder($companyId, $projectId,$id, $data);

    public function deleteFolder($companyId, $projectId,$id);

    public function folderAllTemporary();
}
