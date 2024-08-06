<?php

if (!function_exists('upload_url')) {
    function upload_url($file): string
    {
        return config('custom.upload_url') . '/' . $file;
    }
}
