<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function storeFile(Request $request, $fieldName = 'file')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/', $fileName);
            return $fileName;
        }
        return null;
    }

    public function updateFile(Request $request, $fieldName = 'file', $modelName)
    {
        $fileName = '';
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/' . $fileName);
            if ($modelName->file) {
                Storage::delete('public/uploads/' . $modelName->file);
            }
            return $fileName;
        } else {
            $fileName = $modelName->file;
            return $fileName;
        }
    }
}
