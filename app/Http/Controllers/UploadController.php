<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Http\Requests\Uploads\StoreUploadRequest;
use App\Http\Requests\Uploads\UpdateUploadRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(StoreUploadRequest $request)
    {
        $file = UploadHelper::uploadFile($request->file('file'));

        return response()->json([
            'status' => 'success',
            'file' => $file
        ]);
    }

    public function update(UpdateUploadRequest $request, $id)
    {
        $document = Document::find($id);
        $file = UploadHelper::updateFile($request->file('file'), $document);

        return response()->json([
            'status' => 'success',
            'file' => $file
        ]);
    }
}
