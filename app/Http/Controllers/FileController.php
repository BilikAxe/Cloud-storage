<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadRequest;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Service\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FileController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function addFile(FileRequest $request, FileService $fileService): RedirectResponse
    {
        $file = $request->file('file');

        try {
            $directoryId = $request->get('directoryId');
            $fileService->createFile($file, $directoryId);

        } catch (\Throwable $throwable) {
            report($throwable);
            throw $throwable;
        }

        return back();
    }


    public function downloadFile(DownloadRequest $request): StreamedResponse
    {
        $fileId = $request->get('fileId');
        $file = File::find($fileId);

        return Storage::disk('public')->download($file->getPublicPath());
    }
}
