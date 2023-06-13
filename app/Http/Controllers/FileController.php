<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileDeleteRequest;
use App\Http\Requests\FileDownloadRequest;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function addFile(FileRequest $request, FileService $fileService): RedirectResponse
    {
        $file = $request->file('file');
        $directoryId = $request->get('directoryId');

        $fileService->createFile($file, $directoryId);

        return back();
    }


    public function downloadFile(FileDownloadRequest $request): RedirectResponse
    {
        $fileId = $request->get('fileId');
        $file = File::find($fileId);

        Storage::disk('public')->download($file->getPublicPath());

        return back();
    }


    public function deleteFile(FileDeleteRequest $request): RedirectResponse
    {
        $fileId = $request->get('fileId');
        $file = File::find($fileId);
        $path = $file->path;
        $file->delete();
        Storage::disk('public')->delete($path);

        return back();
    }
}
