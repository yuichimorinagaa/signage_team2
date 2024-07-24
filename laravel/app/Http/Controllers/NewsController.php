<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Exception;

class NewsController extends Controller
{
    public function index()
    {

        try {
            $url = config('newsapi.news_api_url_3') ;
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

        } catch (RequestException $e) {
            // Guzzleの例外が発生した場合のエラーハンドリング
            $message = 'Failed to fetch news data';
            if ($e->hasResponse()) {
                $message .= ': ' . $e->getResponse()->getBody()->getContents();
            }
            return response()->json(['error' => $message], 500);
        } catch (Exception $e) {
            // その他の例外が発生した場合のエラーハンドリング
            return response()->json(['error' => 'Failed to fetch news data'], 500);
        }

        return view('user.newsApi', compact('news'));
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

        } catch (RequestException $e) {
            // Guzzleの例外が発生した場合のエラーハンドリング
            $message = 'Failed to fetch news data';
            if ($e->hasResponse()) {
                $message .= ': ' . $e->getResponse()->getBody()->getContents();
            }
            return response()->json(['error' => $message], 500);
        }
    }
}
