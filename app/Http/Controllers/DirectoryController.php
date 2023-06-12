<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectoryDeleteRequest;
use App\Http\Requests\DirectoryRequest;
use App\Models\Directory;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DirectoryController extends Controller
{
    public function openHomePage(int $id=null): Factory|View|Application
    {
        $files = File::all()->where('user_id', Auth::id())->where('directory_id', $id);
        $directories = Directory::all()->where('user_id', Auth::id())->where('parent_id', $id);

        return view('file', [
            'id' => $id,
            'files' => $files,
            'directories' => $directories,
        ]);
    }


    public function create(DirectoryRequest $request): RedirectResponse
    {
        Directory::create([
            'name' => $request->get('directoryName'),
            'user_id' => Auth::id(),
            'parent_id' => $request->get('parentId'),
        ]);

        return back();
    }


    public function delete(DirectoryDeleteRequest $request): RedirectResponse
    {
        $directoryId = $request->get('directoryId');
        dd(Directory::all()->where('parent_id', $directoryId));
//        $files = File::all()->where('directory_id', $directoryId);
//        foreach ($files as $file) {
//            Storage::disk('public')->delete($file->path);
//        }
//
//        Directory::find($directoryId)->delete();

        return back();
    }
}
