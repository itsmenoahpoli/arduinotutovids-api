<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FilesService
{
    public static function getFileFromStorage($path)
    {
        $file = Storage::get($path);

        if (!$file)
        {
            throw new NotFoundHttpException('File not found');
        }

        $mimeType = Storage::mimeType($file);

        return [
            'file'      => $file,
            'mimeType'  => $mimeType
        ];
    }
}
