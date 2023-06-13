<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @throws \Throwable
     */
    public function createFile(UploadedFile $uploadedFile, ?int $directoryId): void
    {
        $path = $uploadedFile->store('files', 'public');

        try {
            File::create([
                'name'         => $uploadedFile->getClientOriginalName(),
                'size'         => $uploadedFile->getSize(),
                'user_id'      => Auth::id(),
                'path'         => $path,
                'directory_id' => $directoryId,
            ]);
        } catch (\Throwable $throwable) {
            Storage::disk('public')->delete($path);
            throw $throwable;
        }
    }
}
