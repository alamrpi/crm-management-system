<?php

namespace App\Services\Interfaces;

interface IFileOperationService
{
    public function upload($file, $folder);
    public function uploads($files, $folder);
    public function delete($filePath);
    public function Crop($file, $folder, $height, $width);

}
