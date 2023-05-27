<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function openMain(): Factory|View|Application
    {
        return view('main');
    }

    public function addFile(Request $request): RedirectResponse
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

        File::create([
            'name' => $name,
            'size' => $size,
            'user_id' => $userId,
            'path' => $path,
        ]);

        return back();
    }
}
