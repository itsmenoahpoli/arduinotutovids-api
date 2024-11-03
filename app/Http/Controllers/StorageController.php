<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FilesService;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function getFileFromStorage(Request $request)
    {
        $path = $request->query('path');
        $file = FilesService::getFileFromStorage($path);

        return response($file['file'], 200)->header('Content-Type', $file['mimeType']);
    }
}
