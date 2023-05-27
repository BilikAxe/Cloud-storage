<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        $file= $request->file('file');
        $file->store('files', 'public');

        return back();
    }
}
