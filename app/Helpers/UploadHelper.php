<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadHelper
{
    public static function uploadFile($file)
    {
        try {
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(config('custom.upload_dir'), $fileName);
//            $file->storeAs(config('custom.upload_dir'), $fileName);
            return $fileName;
        } catch (\Throwable $throwable) {
            Log::error($throwable);
        }
        return false;
    }

    public static function updateFile($file, $modelName)
    {
        $fileName = '';
        try {
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(config('custom.upload_dir'), $fileName);
            if ($modelName->upload->full_name)
                Storage::delete(config('custom.upload_dir') . $modelName->upload->full_name);
            return $fileName;
        } catch (\Throwable $throwable) {
            Log::error($throwable);
        }
        return false;
    }

//    public static function urlify($filename)
//    {
//        return config('custom.upload_dir') . $filename;
//    }
}
