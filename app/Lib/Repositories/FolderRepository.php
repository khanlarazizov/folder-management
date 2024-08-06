<?php

namespace App\Lib\Repositories;

use App\Lib\Exceptions\ModelNotDeletedException;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Exceptions\ModelNotStoredException;
use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Models\Folder;
use App\Models\Project;

class FolderRepository implements IFolderRepository
{
    public function getAllFolders($companyId, $projectId, $data)
    {
        $project = Project::find($projectId);
        if ($project == null)
            throw new ModelNotFoundException("Səhifə tapılmadı");

        $folders = $project->folders()
            ->with('project')
            ->name($data['name'])
            ->date($data['startDate'],$data['endDate']);
//            ->date($data['startDate'],$data['endDate']);
//        dd($data);
        return $folders;
    }

    public function getFolderById($companyId, $projectId, $id)
    {
        $folder = Folder::find($id);
        if ($folder == null)
            throw new ModelNotFoundException('Qovluq tapılmadı');
        return $folder;
    }

    public function createFolder($companyId, $projectId, $data)
    {
        try {
            $project = Project::find($projectId);
            $folder = $project->folders()->create($data);
            return $folder;
        } catch (\Exception $e) {
            throw new ModelNotStoredException('Qovluq Yadda saxlanılmadı');
        }
    }

    public function updateFolder($companyId, $projectId, $id, $data)
    {
        $folder = Folder::find($id);
        if ($folder == null)
            throw new ModelNotStoredException('Qovluq Redaktə edilmədi');
        $folder->update($data);

    }

    public function deleteFolder($companyId, $projectId, $id)
    {
        $folder = Folder::find($id);
        if ($folder == null)
            throw new ModelNotDeletedException('Qovluq Silinmədi');
        $folder->delete();


    }

    public function folderAllTemporary()
    {
        return Folder::all();
    }
}
