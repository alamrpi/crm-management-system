<?php

namespace App\Services;

use App\Services\Interfaces\IFileOperationService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class FileOperationService implements IFileOperationService
{


    /**
     * @param $file
     * @param string $folder upload to the folder
     * @return array file general information
     */
    public function upload($file, $folder): array
    {
        $file_name = $this->generateFileName($file);
        $filePath = $folder . '/' . $file_name;

        $file->move($folder, $file_name);

        $ext = $file->getClientOriginalExtension();
        return array(
            'path' => $filePath,
            'ext' => $ext,
            'mime' => $file->getClientMimeType(),
            'original_name' => pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME) .'.'.$ext,
            'size' => $this->getFileSize($filePath)
        );
    }

    /**
     * Uploads multiple files
     *
     * @param $files
     * @param string $folder upload to the folder
     * @return array
     */
    public function uploads($files, $folder): array
    {
        $uploaded_files = [];
        foreach ($files as $file){
            $uploaded_files[] = $this->upload($folder, $file);
        }
        return $uploaded_files;
    }

    /**
     * @param string $filePath File Full Path with file name
     * @return void
     */
    public function delete($filePath): void
    {
        if(File::exists($filePath))
            File::delete($filePath);
    }

    public function Crop($file, $folder, $height, $width)
    {
        $file_name = $this->generateFileName($file);
        $filePath = $folder . '/' . $file_name;

        $img = ImageManagerStatic::make($file);
        $img->resize($width, $height);
        $img->save($filePath);

        return $filePath;
    }


    /**
     * Get File size in KB
     *
     * @param string $file_path
     * @return float
     */
    private function getFileSize(string $file_path): float
    {
        $bytes = File::size($file_path);
        return ceil($bytes/1024);
    }


    /**
     * Generate file name in random
     *
     * @param $file
     * @return string
     */
    private function generateFileName($file):string
    {
        return 'wb_'.date('Ymd') . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
    }

}
