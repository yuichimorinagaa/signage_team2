<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Client;
use Exception;

class UserController extends Controller
{
    public function index() {

        $cityName='Kawasaki';
        $apiKey = '98371b3bc8058204e1013851c7064d92';
        $url = "http://api.openweathermap.org/data/2.5/weather?units=metric&lang=ja&q=$cityName&appid=$apiKey";

        $method = "GET";

        $client = new Client();

        try {
            // APIにリクエストを送信し、レスポンスを取得
            $response = $client->request($method, $url);
            $data = $response->getBody();
            $weatherData = json_decode($data, true);

            // 天気と気温に関するデータを抽出
            $weather = [
                'datetime' => date('Y-m-d H:i:s', $weatherData['dt']),
                'description' => $weatherData['weather'][0]['description'],
                'temperature' => $weatherData['main']['temp'],
                'feels_like' => $weatherData['main']['feels_like'],
                'humidity' => $weatherData['main']['humidity'],
                'wind_speed' => $weatherData['wind']['speed']
            ];

            // ビューにデータを渡す
            return view('user.testApi', ['weather' => $weather]);

        } catch (Exception $e) {
            // エラーハンドリング
            return view('weather.error', ['error' => $e->getMessage()]);
        }
    }
}





