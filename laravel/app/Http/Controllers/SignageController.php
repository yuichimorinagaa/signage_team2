<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Exception;
use GuzzleHttp\Client;
use App\Models\File;
use Illuminate\Support\Facades\Cache;


class SignageController extends Controller
{
    public function index(){
        $images = File::where('status', 1)->get();

        $profiles = Profile::all();


            return view('signage.index', ['images' => $images, 'profiles' => $profiles]);

}
    public function fetchWeather()
    {
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

        if (Cache::has('news')) {
            return response()->json(Cache::get('news'));
        }

        try {
            $url = config('newsapi.news_api_url_3');
            $method = "GET";
            $count = 1;

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];

            for ($id = 0; $id < $count; $id++) {
                array_push($news, [
                    'name' => $articles['articles'][$id]['title'],
                    'url' => $articles['articles'][$id]['url'],
                    'description' => $articles['articles'][$id]['description'],
                    'thumbnail' => $articles['articles'][$id]['urlToImage']
                ]);
            }



            // キャッシュに保存（5分間）
            Cache::put('news', $news, now()->addMinutes(5));
            return response()->json($news);

        } catch (Exception $e) {
            // Guzzleの例外が発生した場合のエラーハンドリング
            $message = 'Failed to fetch news data';
            if ($e->hasResponse()) {
                $message .= ': ' . $e->getResponse()->getBody()->getContents();
            }
            return response()->json(['error' => $message], 500);
        }
    }
    public function success(){
        return view('signage.success');
    }
}
