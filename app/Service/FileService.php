<?php

namespace App\Service;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class FileService
{
    public function createFile(UploadedFile $file, ?int $directoryId): void
    {
        File::create([
            'name'         => $file->getClientOriginalName(),
            'size'         => $file->getSize(),
            'user_id'      => Auth::id(),
            'path'         => $file->store('files', 'public'),
            'directory_id' => $directoryId,
        ]);
    }
}
