<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SignageController extends Controller
{
    public function index(){
        $images = File::where('status', 1)->get();

        $profiles = Profile::all();

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

        //ニュースの表示
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=jp&category=sports&apiKey=16cb0be0a0be46baae38a3c6a2ebf8fb'); // 実際のAPIエンドポイントに置き換えてください
        $newsData = $response->json();

        $articles = $newsData['articles'];

        return view('signage.index', ['images' => $images, 'profiles' => $profiles, 'weather' => $weather, 'news' => $articles]);
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
    public function fetchNews()
    {
        // APIからニュースデータを取得
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=jp&category=sports&apiKey=16cb0be0a0be46baae38a3c6a2ebf8fb'); // 実際のAPIエンドポイントに置き換えてください
        $newsData = $response->json();

        $articles = $newsData['articles'];

        // データをJSONで返す
        return response()->json($newsData);
    }
}
