<?php

namespace App\Service;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class FileService
{
    public function createFile(UploadedFile $uploadedFile, ?int $directoryId): void
    {
        File::create([
            'name'         => $uploadedFile->getClientOriginalName(),
            'size'         => $uploadedFile->getSize(),
            'user_id'      => Auth::id(),
            'path'         => $uploadedFile->store('files', 'public'),
            'directory_id' => $directoryId,
        ]);
    }
}
