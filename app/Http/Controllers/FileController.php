<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileDeleteRequest;
use App\Http\Requests\FileDownloadRequest;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\User;
use App\Services\FileService;
use App\Services\RabbitMQService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        $dieTime = $request->get('die');
        $fileService->createFile($file, $directoryId, $dieTime);

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
        $file->delete();

        return back();
    }


    public function deleteOldFile(): RedirectResponse
    {
        $currentTime = Carbon::now();
        $files = File::all()->where('die_at', '<', $currentTime);

        foreach ($files as $file) {
            $file->delete();
        }

        return redirect()->route('main');
    }
}
