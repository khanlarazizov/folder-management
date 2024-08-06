<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folders\StoreFolderRequest;
use App\Http\Requests\Folders\UpdateFolderRequest;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FolderController extends Controller
{
    public $folder;
    public $project;
    public $company;

    public function __construct(IFolderRepository $folder, IProjectRepository $project, ICompanyRepository $company)
    {
        $this->folder = $folder;
        $this->project = $project;
        $this->company = $company;
    }

    public function index($companyId, $projectId,Request $request)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folders = $this->folder->getAllFolders($companyId, $projectId,$request)->paginate(5);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
        return view('folders.folder.index', compact('folders', 'company', 'project'));
    }

    public function store($companyId, $projectId, StoreFolderRequest $request)
    {
        $this->folder->createFolder($companyId, $projectId, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function edit($companyId, $projectId, $id)
    {
        $folder = $this->folder->getFolderById($companyId, $projectId, $id);

        return response()->json($folder);
    }

    public function update($companyId, $projectId, $id, UpdateFolderRequest $request)
    {
        $this->folder->updateFolder($companyId, $projectId, $id, $request->validated());

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy($companyId, $projectId, $id)
    {
        $this->folder->deleteFolder($companyId, $projectId, $id);
    }
}
