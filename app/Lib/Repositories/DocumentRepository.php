<?php

namespace App\Lib\Repositories;

use App\Helpers\UploadHelper;
use App\Lib\Exceptions\ModelNotDeletedException;
use App\Lib\Exceptions\ModelNotFoundException;
use App\Lib\Exceptions\ModelNotStoredException;
use App\Lib\Repositories\Interfaces\IDocumentRepository;
use App\Models\Document;
use App\Models\DocumentDetail;
use App\Models\Folder;
use App\Models\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DocumentRepository implements IDocumentRepository
{
    public function getAllDocuments($companyId, $projectId, $folderId, $data)
    {
        $folder = Folder::find($folderId);

        if ($folder == null)
            throw new ModelNotFoundException('Səhifə tapılmadı');

//        dd($folder->documents()->with('documentDetail', 'upload')->get());
        $documents = $folder->documents()->with('documentDetail', 'upload', 'tags')
            ->number($data['number'])
            ->date($data['startDate'], $data['endDate'])
            ->currency($data['currency'])
            ->documentType($data['document_type'])
            ->price($data['price'])
            ->contract($data['contract_id'])
//            ->addition($data['addition_id'])
            ->contractType($data['contract_type'])
            ->shopping($data['shopping'])
            ->otherSideType($data['other_side_type'])
//            ->otherSideName($data['other_side_name'])
            ->productServiceName($data['product_service_name'])
            ->productServiceNumberInteger($data['product_service_number_integer'])
            ->productServiceNumberString($data['product_service_number_string'])
            ->paginate(5);
        return $documents;
    }

    public function getDocumentById($companyId, $projectId, $folderId, $id)
    {

        $document = Document::find($id);
        if ($document == null)
            throw new ModelNotFoundException('Sənəd tapılmadı');

        return Document::find($id)->load('documentDetail', 'folder:id,name', 'tags');
    }

    public function createDocument($companyId, $projectId, $folderId, $data)
    {
        try {
            DB::beginTransaction();

            $document = Document::create([
                'number' => $data['number'],
                'document_type' => $data['document_type'],
                'date' => $data['date'],
                'folder_id' => $folderId,
                'currency' => $data['currency'],
                'price' => $data['price'],
            ]);

            $document->tags()->attach($data['tags']);

            DocumentDetail::create([
                'document_id' => $document->id,
                'contract_id' => $data['contract_id'] ?? null,
                'addition_id' => $data['addition_id'] ?? null,
                'contract_type' => $data['contract_type'] ?? null,
                'shopping' => $data['shopping'] ?? null,
                'other_side_type' => $data['other_side_type'] ?? null,
                'other_side_name' => $data['other_side_name'] ?? null,
                'product_service_name' => $data['product_service_name'] ?? null,
                'product_service_number_integer' => $data['product_service_number_integer'] ?? null,
                'product_service_number_string' => $data['product_service_number_string'] ?? null,
            ]);

//            $filePath = UploadHelper::urlify($data['uploaded_file']);
            $filePath = $data['uploaded_file'];
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            Upload::create([
                'document_id' => $document->id,
                'name' => $fileName,
                'path' => $filePath,
                'extension' => $fileExtension,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ModelNotStoredException('Sənəd Yadda saxlanılmadı');
        }
    }

    public function updateDocument($companyId, $projectId, $folderId, $id, $data)
    {
        try {
            DB::beginTransaction();

            $document = Document::find($id);

            $document->update([
                'number' => $data['number'],
                'document_type' => $data['document_type'],
                'folder_id' => $folderId,
                'date' => $data['date'],
                'currency' => $data['currency'],
                'price' => $data['price'],
            ]);

            $filePath = $data['uploaded_file'];
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            $document->upload()->update([
                'name' => $fileName,
                'path' => $filePath,
                'extension' => $fileExtension,
            ]);

            $document->tags()->sync($data['tags']);

            $document->documentDetail()->update([
                'contract_id' => $data['contract_id'] ?? null,
                'addition_id' => $data['addition_id'] ?? null,
                'contract_type' => $data['contract_type'] ?? null,
                'shopping' => $data['shopping'] ?? null,
                'other_side_type' => $data['other_side_type'] ?? null,
                'other_side_name' => $data['other_side_name'] ?? null,
                'product_service_name' => $data['product_service_name'] ?? null,
                'product_service_number_integer' => $data['product_service_number_integer'] ?? null,
                'product_service_number_string' => $data['product_service_number_string'] ?? null,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ModelNotStoredException('Sənəd Redaktə edilmədi');
        }
    }

    public function deleteDocument($companyId, $projectId, $folderId, $id)
    {
        try {
            DB::beginTransaction();
            $document = Document::find($id);
            if (Storage::delete('public/uploads/' . $document->upload->name.'.'.$document->upload->extension)) {
                $document->documentDetail->delete();
                $document->tags()->detach();
                $document->delete();
                $document->upload->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ModelNotDeletedException('Sənəd Silinmədi');
        }
    }

    public function getContracts($folderId)
    {
        $contracts = Document::where('document_type', '=', 'Müqavilə')
            ->where('folder_id', '=', $folderId)
            ->select('id', 'number')->get();
        return $contracts;
    }

    public function getDocuments()
    {
        $documents = DB::table('documents')
            ->leftjoin('document_details', 'documents.id', '=', 'document_details.document_id')->get();
        return $documents;
    }

    public function getAllAdditions($data)
    {
        $documents = DB::table('documents')
            ->leftjoin('document_details', 'documents.id', '=', 'document_details.document_id')->get();
        $additions = $documents
            ->where('contract_id', $data->contract_id)
            ->where('document_type', '!=', 'Təhvil-təslim aktı');

        return $additions;
    }
}
