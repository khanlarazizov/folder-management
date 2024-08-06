<?php

namespace App\Lib\Repositories\Interfaces;


interface IDocumentRepository
{
    public function getAllDocuments($companyId, $projectId, $folderId, $data);

    public function getDocumentById($companyId, $projectId, $folderId, $id);

    public function createDocument($companyId, $projectId, $folderId, $data);

    public function getContracts($folderId);

    public function getAllAdditions($data);

    public function getDocuments();

    public function updateDocument($companyId, $projectId, $folderId, $id, $data);

    public function deleteDocument($companyId, $projectId, $folderId, $id);
}
