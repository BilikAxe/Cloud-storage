<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectoryDeleteRequest;
use App\Http\Requests\DirectoryRequest;
use App\Models\Directory;
use App\Models\File;
use App\Models\User;
use App\Services\DirectoryService;
use App\Services\WeatherService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DirectoryController extends Controller
{
    public function __construct(public WeatherService $weatherService)
    {
    }


    public function openHomePage(Request $request, int $id=null): Factory|View|Application
    {
        $files = File::all()->where('user_id', Auth::id())->where('directory_id', $id);
        $directories = Directory::all()->where('user_id', Auth::id())->where('parent_id', $id);

        $search = $request->get('search');
        if ($search !== null) {
            $files = File::where('name', 'ilike', '%' . $search . '%')->orWhere('owner', 'ilike', '%' . $search . '%')->get();
            $directories = Directory::where('name', 'ilike', '%' . $search . '%')->orWhere('owner', 'ilike', '%' . $search . '%')->get();
        }

        $latitude = round((float)$request->get('ltd'), 1);
        $longitude = round((float)$request->get('lng'), 1);

        $weather = $this->weatherService->getWeather($latitude, $longitude);

        return view('file', [
            'id' => $id,
            'files' => $files,
            'directories' => $directories,
            'weather' => $weather,
        ]);
    }


    public function create(DirectoryRequest $request): RedirectResponse
    {
        $owner = Auth::user();
//        dd($owner);

        Directory::create([
            'name'          => $request->get('directoryName'),
            'user_id'       => Auth::id(),
            'parent_id'     => $request->get('parentId'),
            'owner'         => $owner->user_name,
        ]);

        return back();
    }


    public function delete(DirectoryDeleteRequest $request, DirectoryService $directoryClearService): RedirectResponse
    {
        $directoryId = $request->get('directoryId');
        $directoryClearService->clearDirectory($directoryId);

        return back();
    }
}
