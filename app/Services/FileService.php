<?php

namespace App\Services;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @throws \Throwable
     */
    public function createFile(UploadedFile $uploadedFile, ?int $directoryId, ?string $dieTime): void
    {
        $path = $uploadedFile->store('files', 'public');
        $owner = Auth::user();

        try {
            File::create([
                'name'         => $uploadedFile->getClientOriginalName(),
                'size'         => $uploadedFile->getSize(),
                'user_id'      => Auth::id(),
                'owner'        => $owner->user_name,
                'path'         => $path,
                'directory_id' => $directoryId,
                'die_at' => $dieTime,
            ]);
        } catch (\Throwable $throwable) {
            Storage::disk('public')->delete($path);
            throw $throwable;
        }
    }
}
