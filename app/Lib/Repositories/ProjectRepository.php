<?php

namespace App\Lib\Repositories;

use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use App\Models\Company;
use App\Models\Project;

class ProjectRepository implements IProjectRepository
{

    public function getAllProject($companyId, $data)
    {
        $company = Company::find($companyId);
        if($company == null)
            throw new ModelNotFoundException("Səhifə tapılmadı");

        $projects = $company->projects()->with('company')->name($data['name'])->paginate(5);

        return $projects;
    }

    public function getProjectById($companyId, $id)
    {
        return Project::find($id);

    }

    public function createProject($companyId, $data)
    {
        $company = Company::find($companyId);
        $project =  $company->projects()->create($data);
        return $project;
    }

    public function updateProject($companyId, $data, $id)
    {
        return Project::find($id)->update($data);
    }

    public function deleteProject($companyId, $id)
    {
        Project::find($id)->delete();
    }
}
