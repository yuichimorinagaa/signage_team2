<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url={{ route('file.index') }}">
    <title>アップロード完了</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#F0F5F9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message-container p {
            font-size: 18px;
            margin: 10px 0;
        }
        .message-container a {
            color: #3498db;
            text-decoration: none;
        }
        .message-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="message-container">
    <p>画像のアップロードが完了しました</p>
    <p>5秒後にアップロード画面に自動的に戻ります</p>
    <p>自動的に戻らない場合は、<a href="{{ route('file.index') }}">こちら</a>をクリックしてください</p>
</div>
</body>
</html>
