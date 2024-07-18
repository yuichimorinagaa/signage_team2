<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>現在の天気情報</h1>

<p><strong>天気:</strong> {{ $weather['description'] }}</p>
<p><strong>気温:</strong> {{ $weather['temperature'] }} ℃</p>
<p><strong>体感気温:</strong> {{ $weather['feels_like'] }} ℃</p>
<p><strong>湿度:</strong> {{ $weather['humidity'] }}%</p>
<p><strong>風速:</strong> {{ $weather['wind_speed'] }} m/s</p>

<p>Icon: <img src="http://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="Weather Icon"></p>


<div id="weather-info">
    <!-- 天気情報をここに表示 -->
</div>

<script>
    $(document).ready(function() {
        function fetchWeatherData() {
            $.ajax({
                url: '{{ route('fetch.weather') }}', // APIデータ取得のURL
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        $('#weather-info').html('<p>' + data.error + '</p>');
                    } else {
                        $('#weather-info').html(`
                                <p>気温: ${data.temperature}°C</p>
                                <p>天気: ${data.description}</p>
                                <p>湿度: ${data.humidity}%</p>
                                <p>風速: ${data.wind_speed} m/s</p>
                                <p>Icon<img src="http://openweathermap.org/img/wn/${data.icon}@2x.png" alt="Weather Icon"></p>
                            `);
                    }
                },
                error: function() {
                    $('#weather-info').html('<p>Failed to fetch weather data.</p>');
                }
            });
        }

        setInterval(fetchWeatherData, 300000); // 5分ごとにデータを取得
        fetchWeatherData(); // 初回データ取得
    });
</script>
</body>
</html>
