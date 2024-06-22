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

<h1>User&File 一覧</h1>
<table>
    <thead>
    <tr>
        <th>メールアドレス</th>
        <th>ファイルパス</th>
    </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr>
            <td>{{$file->user->email}}</td>
            <td>{{$file->file_path}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<form action="{{ route('tests.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="image">画像を選択:</label>
        <input type="file" name="image" id="image">
    </div>
    <button type="submit">ファイルをアップロードする（テスト）</button>
</form>

</body>
</html>
