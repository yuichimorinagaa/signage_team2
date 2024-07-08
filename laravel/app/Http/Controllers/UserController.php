<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function index() {

        $cityName='Tokyo';
        $apiKey = '98371b3bc8058204e1013851c7064d92';
        $url = "http://api.openweathermap.org/data/2.5/forecast?units=metric&lang=ja&q=$cityName&appid=$apiKey";

        $method = "GET";

        $client = new Client();

        try {
            $response = $client->request($method, $url);
            $data = $response->getBody();
            $data = json_decode($data, true);

            // 天気と気温に関するデータを抽出
            $weatherData = [];
            foreach ($data['list'] as $forecast) {
                $weatherData[] = [
                    'datetime' => $forecast['dt_txt'],
                    'description' => $forecast['weather'][0]['description'],
                    'temperature' => $forecast['main']['temp'],
                    'feels_like' => $forecast['main']['feels_like'],
                    'humidity' => $forecast['main']['humidity'],
                    'wind_speed' => $forecast['wind']['speed']
                ];
            }

            // データをビューに渡す
            return view('user.testApi', ['weatherData' => $weatherData]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // エラーメッセージを処理する
            return response()->json(['error' => 'APIリクエストが失敗しました。'], 500);
        }
    }
}





