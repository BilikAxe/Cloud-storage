<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function openMain(): Factory|View|Application
    {
        $files = $this->getFiles();

//        dd($files);
        return view('main', ['files' => $files]);
    }

    public function addFile(FileRequest $request): RedirectResponse
    {
        if (!$request->hasFile('file')) {
            return back()
                ->withInput()
                ->withErrors([
                    'file' => 'File not selected'
                ]);
        }

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


    public function getFiles(): Collection
    {
        return DB::table('files')->where('user_id', Auth::id())->get();
    }
}
