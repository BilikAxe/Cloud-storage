<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\Directory;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class FileController extends Controller
{
    public function openHomePage(int $id=0): Factory|View|Application
    {
        $files = File::all()->where('user_id', Auth::id())->where('parent', $id);
        $directories = Directory::all()->where('user_id', Auth::id())->where('parent', $id);

        return view('file', [
            'id' => $id,
            'files' => $files,
            'directories' => $directories,
        ]);
    }


    public function addFile(FileRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $path = $file->store('files', 'public');
        $userId = Auth::id();
        $size = $file->getSize();
        $parent = $request->parent;

//        $files = File::all()->where('name', $name);
//
//        foreach ($files as $file) {
//            if ($file->name === $name && $file->parent === $parent) {
//                return back()->withInput()->withErrors([
//                    'file' => 'Файл с таким именем уже существует'
//                ]);
//            }
//        }

        File::create([
            'name' => $name,
            'size' => $size,
            'user_id' => $userId,
            'path' => $path,
            'parent' => $parent,
        ]);

        return back();
    }


    public function downloadFile(Request $request): BinaryFileResponse
    {
        $fileId = $request->get('fileId');
        $file = File::find($fileId);

        $path = public_path() . '/storage/' . $file->path;
//        $path = Storage::download($file->path);


        return response()->download($path);
//        return Storage::download($file->path);
    }
}
