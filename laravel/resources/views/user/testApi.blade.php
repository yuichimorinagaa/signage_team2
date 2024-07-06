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
<h1>天気情報</h1>

@if(isset($weatherData))
    <table>
        <thead>
        <tr>
            <th>日時</th>
            <th>天気</th>
            <th>気温 (°C)</th>
            <th>体感温度 (°C)</th>
            <th>湿度 (%)</th>
            <th>風速 (m/s)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($weatherData as $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($data['datetime'])->format('Y-m-d H:i') }}</td>
                <td>{{ $data['description'] }}</td>
                <td>{{ $data['temperature'] }}</td>
                <td>{{ $data['feels_like'] }}</td>
                <td>{{ $data['humidity'] }}</td>
                <td>{{ $data['wind_speed'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>天気情報を取得できませんでした。</p>
@endif
</body>
</html>
