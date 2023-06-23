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
        $latitude = round((float)$request->get('ltd'), 1);
        $longitude = round((float)$request->get('lng'), 1);

        $weather = $this->weatherService->getWeather($latitude, $longitude);

        return json_encode([
            'city' => $weather->name,
            'temp' => $weather->main->temp,
        ]);
    }
}
