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

<script>
    document.getElementById('fullscreenButton').addEventListener('click', function() {
        var elem = document.getElementById('content');
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { // Firefox
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { // Chrome, Safari, Opera
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { // IE/Edge
            elem.msRequestFullscreen();
        }
    });
</script>
</body>
</html>

.btn-danger{
float:right;
background-color: rgba(255, 255, 255, 0.3);
transition:all 0.5s;
border-color:rgba(255, 255, 255, 0.3);
height:45px;
cursor:pointer;
}
header {
height: 45px;
width: 100%;
background-color: rgba(34, 49, 52, 0.9);

}
header p{
color:white;
font-size:30px;
font-family: "Noto Serif", sans-serif;
font-weight:bold;
float:left
}

#image-list {
width: 20%;
padding: 10px;
box-sizing: border-box;
overflow-y: auto;
border-right: 1px solid #ccc;
}
#image-list img {
width: 100%;
height: auto;
aspect-ratio: 16 / 9;
object-fit: cover;
}

#slideshow img {
max-width: 100%;
max-height: 100%;
aspect-ratio: 16 / 9;
object-fit: cover;
}
.message{
text-align:center;
vertical-align: center;
}
.navigation {
margin-top: 100px;
display: flex;
justify-content: center;
}
.navigation button {
background-color: floralwhite;
border: none;
padding: 10px 20px;
cursor: pointer;
}
.navigation button:hover {
background-color: gray;
}
.form-container {
text-align: center;
padding: 10px;
}
.form-container button {
background-color: navajowhite;
border: none;
padding: 10px 20px;
cursor: pointer;
}
.form-container button:hover {
background-color: gray;
}
