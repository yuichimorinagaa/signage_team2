<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="//../css/bootstrap.min.cssZone.Identifier" rel="stylesheet">
</head>
<body>
<h2>画像選択画面</h2>
<form action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" >
    <input type="submit" class="btn btn-primary " value="投稿">
</form>

@foreach($files as $file)
    <div>
        <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像の説明">
        <form action="{{ route('file.delete',['id'=>$file->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary ">削除</button>
        </form>
    </div>
@endforeach

</body>
</html>
