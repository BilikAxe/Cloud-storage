<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class FileController extends Controller
{
    public function openHomePage(): Factory|View|Application
    {
        $files = File::all()->where('user_id', Auth::id());

        return view('file', ['files' => $files]);
    }


    public function addFile(FileRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $path = $file->store('files', 'public');
        $userId = Auth::id();
        $size = $file->getSize();

        if ($name === DB::table('files')->where('name', $name)->value('name')) {
            return back()->withInput()->withErrors([
                'file' => 'Файл с таким именем уже существует'
            ]);
        }

        File::create([
            'name' => $name,
            'size' => $size,
            'user_id' => $userId,
            'path' => $path,
        ]);

        return back()->withInput()->with('success', 'Файл успешно загружен');
    }


    public function downloadFile(Request $request): BinaryFileResponse
    {
        $fileId = $request->get('fileId');
        $fileArray = File::find($fileId)->toArray();

        $path = public_path() . '/storage/' . $fileArray['path'];

        return response()->download($path);
    }
}
