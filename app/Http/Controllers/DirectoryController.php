<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DirectoryController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        Directory::create([
            'name' => $request->directoryName,
            'user_id' => Auth::id(),
            'parent' => $request->parent,
        ]);

        return back();
    }
}
