<?php

namespace App\Services;

use App\Models\Directory;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileDeleteService
{
    public function deleteFile(int $parentId): void
    {
        $files = File::all()->where('directory_id', $parentId);

        foreach ($files as $file) {
            Storage::disk('public')->delete($file->path);
        }

        $directories = Directory::all()->where('parent_id', $parentId);

        foreach ($directories as $directory) {
            $this->deleteFile($directory->id);
        }
    }
}
