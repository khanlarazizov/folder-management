<?php

namespace App\Http\Controllers;

use App\Http\Requests\Documents\StoreDocumentRequest;
use App\Http\Requests\Documents\UpdateDocumentRequest;
use App\Lib\Exceptions\ModelNotDeletedException;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Exceptions\ModelNotStoredException;
use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Lib\Repositories\Interfaces\IDocumentRepository;
use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use App\Lib\Repositories\Interfaces\ITagRepository;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public $document;
    public $folder;
    public $project;
    public $company;
    public $tag;

    public function __construct(IDocumentRepository $document, IFolderRepository $folder, IProjectRepository $project, ICompanyRepository $company, ITagRepository $tag)
    {
        $this->document = $document;
        $this->folder = $folder;
        $this->project = $project;
        $this->company = $company;
        $this->tag = $tag;
    }

    public function index($companyId, $projectId, $folderId, Request $request)
    {
        try {
            $folders = $this->folder->folderAllTemporary();
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $contracts = $this->document->getContracts($folderId);

            $documents = $this->document
                ->getAllDocuments($companyId, $projectId, $folderId, $request);

        } catch (ModelNotFoundException $e) {
//            dd($e->getMessage());
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }

        return view('documents.index',
            compact('documents', 'folders', 'folder', 'company', 'project', 'contracts'));
    }

    public function createContract($companyId, $projectId, $folderId)
    {
        $company = $this->company->getCompanyById($companyId);
        $project = $this->project->getProjectById($companyId, $projectId);
        $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
        $tags = $this->tag->getAllTags();

        return view('documents.contract.create',
            compact('company', 'project', 'folder', 'tags'));
    }

    public function createProtocol($companyId, $projectId, $folderId)
    {
        $company = $this->company->getCompanyById($companyId);
        $project = $this->project->getProjectById($companyId, $projectId);
        $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
        $contracts = $this->document->getContracts($folderId);
        $tags = $this->tag->getAllTags();
        return view('documents.protocol.create',
            compact('company', 'project', 'contracts', 'folder', 'tags'));
    }

    public function createContractAddition($companyId, $projectId, $folderId)
    {
        $company = $this->company->getCompanyById($companyId);
        $project = $this->project->getProjectById($companyId, $projectId);
        $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
        $contracts = $this->document->getContracts($folderId);
        $tags = $this->tag->getAllTags();
        return view('documents.contract-addition.create',
            compact('company', 'project', 'contracts', 'folder', 'tags'));
    }

    public function createDeliveryStatement($companyId, $projectId, $folderId)
    {
        $company = $this->company->getCompanyById($companyId);
        $project = $this->project->getProjectById($companyId, $projectId);
        $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
        $contracts = $this->document->getContracts($folderId);
        $tags = $this->tag->getAllTags();

        return view('documents.delivery-statement.create',
            compact('company', 'project', 'contracts', 'folder', 'tags'));
    }

    public function getAddition(Request $request)
    {
        $additions = $this->document->getAllAdditions($request);

        return response()->json([
            'additions' => $additions
        ]);
    }

    public function store($companyId, $projectId, $folderId, StoreDocumentRequest $request)
    {
//        dd($request);
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);

            $this->document->createDocument($companyId, $projectId, $folderId, $request->validated());

            $notification = array(
                'message' => $request->number . " nömrəli sənəd siyahıya uğurla əlavə edildi",
                'alert-type' => 'success'
            );
            return redirect()->route('companies.projects.folders.documents.index',
                compact('company', 'project', 'folder'))->with($notification);
        } catch (ModelNotStoredException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }

    public function showContract($companyId, $projectId, $folderId, $id)
    {
        $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
        return response()->json($document);
    }

    public function showContractAddition($companyId, $projectId, $folderId, $id)
    {
        $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
        $contract_id = $document->documentDetail->contract_id;
        $selected_contract = $this->document->getDocumentById($companyId, $projectId, $folderId, $contract_id);

        return response()->json([
            'document' => $document,
            'selected_contract' => $selected_contract
        ]);
    }

    public function showProtocol($companyId, $projectId, $folderId, $id)
    {
        $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
        $contract_id = $document->documentDetail->contract_id;
        $selected_contract = $this->document->getDocumentById($companyId, $projectId, $folderId, $contract_id);

        return response()->json([
            'document' => $document,
            'selected_contract' => $selected_contract
        ]);
    }

    public function showDeliveryStatement($companyId, $projectId, $folderId, $id)
    {
        $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
        $contract_id = $document->documentDetail->contract_id;
        $addition_id = $document->documentDetail->addition_id;
        $selected_contract = $this->document->getDocumentById($companyId, $projectId, $folderId, $contract_id);
        $selected_addition = $this->document->getDocumentById($companyId, $projectId, $folderId, $addition_id);

        return response()->json([
            'document' => $document,
            'selected_contract' => $selected_contract,
            'selected_addition' => $selected_addition
        ]);
    }

    public function editContract($companyId, $projectId, $folderId, $id)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
            $tags = $this->tag->getAllTags();
            $selectedTags = $document->tags->pluck('id')->toArray();
            return view('documents.contract.edit',
                compact('company', 'project', 'folder', 'document', 'tags', 'selectedTags'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }

    public function editProtocol($companyId, $projectId, $folderId, $id)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
            $contracts = $this->document->getContracts($folderId);
            $tags = $this->tag->getAllTags();
            $selectedTags = $document->tags->pluck('id')->toArray();

            return view('documents.protocol.edit',
                compact('company', 'project', 'contracts', 'folder', 'document', 'tags', 'selectedTags'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }

    public function editContractAddition($companyId, $projectId, $folderId, $id)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
            $contracts = $this->document->getContracts($folderId);
            $tags = $this->tag->getAllTags();
            $selectedTags = $document->tags->pluck('id')->toArray();

            return view('documents.contract-addition.edit',
                compact('company', 'project', 'contracts', 'folder', 'document', 'tags', 'selectedTags'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }

    public function editDeliveryStatement($companyId, $projectId, $folderId, $id)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);
            $contracts = $this->document->getContracts($folderId);
            $tags = $this->tag->getAllTags();
            $selectedTags = $document->tags->pluck('id')->toArray();


            $additions = $this->document->getAllAdditions($document->documentDetail);

            return view('documents.delivery-statement.edit',
                compact('company', 'project', 'contracts', 'folder', 'document', 'additions', 'tags', 'selectedTags'));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }

    public function update($companyId, $projectId, $folderId, $id, UpdateDocumentRequest $request)
    {
        try {
            $company = $this->company->getCompanyById($companyId);
            $project = $this->project->getProjectById($companyId, $projectId);
            $folder = $this->folder->getFolderById($companyId, $projectId, $folderId);
            $document = $this->document->getDocumentById($companyId, $projectId, $folderId, $id);

            $this->document->updateDocument($companyId, $projectId, $folderId, $id, $request->validated());

            $notification = array(
                'message' => $request->number . " nömrəli sənəd siyahıya uğurla redaktə edildi",
                'alert-type' => 'success'
            );
            return redirect()->route('companies.projects.folders.documents.index',
                compact('company', 'project', 'folder', 'document'))->with($notification);
        } catch (ModelNotStoredException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }


    public function delete($companyId, $projectId, $folderId, $id)
    {
        try {
            $this->document->deleteDocument($companyId, $projectId, $folderId, $id);
        } catch (ModelNotDeletedException $e) {
            Log::error($e->getMessage());
            return view("error.404", ['message' => $e->getMessage()]);
        }
    }
}
