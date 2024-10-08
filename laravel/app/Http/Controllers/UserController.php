<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache; // キャッシュを利用するためのファサード
use GuzzleHttp\Client; // HTTPクライアント
use Exception; // 例外クラス

class UserController extends Controller
{
   //初期表示
    public function index()
    {
        $cityName = 'Kawasaki'; // 取得する天気データの都市名
        $apiKey = config('weatherapi.weather_api_key'); // 環境設定からAPIキーを取得
        $url = config('weatherapi.weather_api_url') . "?units=metric&lang=ja&q=$cityName&appid=$apiKey"; // APIのURLを組み立てる


            $client = new Client(); // HTTPクライアントのインスタンスを作成
            try {
                // APIにリクエストを送信し、レスポンスを取得
                $response = $client->request('GET', $url);
                $data = $response->getBody();
                $weatherData = json_decode($data, true); // JSON形式のレスポンスを配列に変換

                // 天気と気温に関するデータを抽出
                $weather = [
                    'datetime' => date('Y-m-d H:i:s', $weatherData['dt']),
                    'description' => $weatherData['weather'][0]['description'],
                    'icon' => $weatherData['weather'][0]['icon'], // アイコン情報を追加
                    'temperature' => $weatherData['main']['temp'],
                    'feels_like' => $weatherData['main']['feels_like'],
                    'humidity' => $weatherData['main']['humidity'],
                    'wind_speed' => $weatherData['wind']['speed']
                ];



            } catch (Exception $e) {
                // エラーハンドリング
                return view('user.testApi', ['error' => $e->getMessage()]);
            }
        // ビューに天気データを渡す
        return view('user.testApi', ['weather' => $weather]);
    }

    public function fetchWeather(){
        if (Cache::has('weather')) {
            return response()->json(Cache::get('weather'));
        }

        $cityName = 'Kawasaki'; // 取得する天気データの都市名
        $apiKey = config('weatherapi.weather_api_key'); // 環境設定からAPIキーを取得
        $url = config('weatherapi.weather_api_url') . "?units=metric&lang=ja&q=$cityName&appid=$apiKey"; // APIのURLを組み立てる

        $client = new Client(); // HTTPクライアントのインスタンスを作成
        try {
            // APIにリクエストを送信し、レスポンスを取得
            $response = $client->request('GET', $url);
            $data = $response->getBody();
            $weatherData = json_decode($data, true); // JSON形式のレスポンスを配列に変換

            // 天気と気温に関するデータを抽出
            $weather = [
                'datetime' => date('Y-m-d H:i:s', $weatherData['dt']),
                'description' => $weatherData['weather'][0]['description'],
                'icon' => $weatherData['weather'][0]['icon'], // アイコン情報を追加
                'temperature' => $weatherData['main']['temp'],
                'feels_like' => $weatherData['main']['feels_like'],
                'humidity' => $weatherData['main']['humidity'],
                'wind_speed' => $weatherData['wind']['speed']
            ];

            // キャッシュに保存（5分間）
            Cache::put('weather', $weather, now()->addMinutes(5));

            return response()->json($weather);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }
    }

}
