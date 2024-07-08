<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>現在の天気情報</h1>
<p><strong>天気:</strong> {{ $weather['description'] }}</p>
<p><strong>気温:</strong> {{ $weather['temperature'] }} ℃</p>
<p><strong>体感気温:</strong> {{ $weather['feels_like'] }} ℃</p>
<p><strong>湿度:</strong> {{ $weather['humidity'] }}%</p>
<p><strong>風速:</strong> {{ $weather['wind_speed'] }} m/s</p>
</body>
</html>
