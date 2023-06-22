<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct(public WeatherService $weatherService)
    {
    }
    public function getWeather(Request $request): bool|string
    {
        $weather = $this->weatherService->getWeather($request);

        return json_encode([
            'city' => $weather->name,
            'temp' => $weather->main->temp,
        ]);
    }
}
