<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeather(float $latitude, float $longitude): object|array
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?&units=metric&lat=${latitude}&lon=${longitude}&appid=3427e46e775a5088d92cbe525359edf0");
        return $response->object();
    }
}
