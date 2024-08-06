<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public $project;
    public $company;

    public function __construct(IProjectRepository $project, ICompanyRepository $company)
    {
        $this->project = $project;
        $this->company = $company;
    }

    public function index($companyId, Request $request)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $projects = $this->project->getAllProject($companyId, $request);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }

        return view('folders.project.index', compact('projects', 'company'));
    }

    public function edit($companyId, $id)
    {
        try {
            $project = $this->project->getProjectById($companyId, $id);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
        return response()->json($project);
    }

    public function store($companyId, StoreProjectRequest $request)
    {
        try {
            $this->project->createProject($companyId, $request->validated());
            return response()->json([
                'status' => 'success'
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update($companyId, UpdateProjectRequest $request, $id)
    {
        try {
            $this->project->updateProject($companyId, $request->validated(), $id);

            return response()->json([
                'status' => 'success'
            ]);
        }catch (ModelNotFoundException $e){
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }

    }

    public function destroy($companyId, $id)
    {
        $this->project->deleteProject($companyId, $id);
    }
}
