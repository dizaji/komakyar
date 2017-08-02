<?php

namespace App\Tools;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function unlink($file_path)
    {
        try {
            return unlink($file_path);
        } catch (\Exception $e) {

        }

        return false;
    }

    public static function store($file, $type)
    {
        return $file->storeAs(config($type, 'other'), time() . '_' . str_random(6) . '.' . $file->extension());
    }

    /**
     * this method will remove file
     * @param $filePath
     */
    public static function delete($filePath)
    {
        if (!is_null($filePath) && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    /**
     * Download uploaded files into FTP server
     *
     * @param $filePath
     * @return string
     */
    public static function downloadFileURL($filePath)
    {
        return config('file.ftp_http_access_url', '') . '/' . $filePath;
        if (Storage::exists($filePath)) {
            return config('file.ftp_http_access_url', '') . '/' . $filePath;
        } else {
            return false;
        }
    }
}
