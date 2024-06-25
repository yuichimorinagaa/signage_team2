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
<form action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" >
    <input type="submit" value="投稿">
</form>
@foreach($image as $file)


    <div>
        <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像の説明">
        <form action="{{ route('file.delete',['id'=>$file->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </div>


@endforeach

</body>
</html>
