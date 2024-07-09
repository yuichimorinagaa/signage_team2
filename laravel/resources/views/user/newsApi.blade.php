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
<div class="container ">
    @foreach($news as $data)
        <div class="card-body pt-0 pb-2">
            <h3 class="h5 card-title">
                <a href="{{$data['url']}}">{{$data['name']}}</a>
            </h3>
            <div class="card-text">
                <img src="{{$data['thumbnail']}}">
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
