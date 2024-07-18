<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- FontAwesomeの読み込み -->
    <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
    <title>Document</title>

    <style>
        body {
            display: flex;  /*フレックスコンテナの指定*/
            flex-direction: column; /*アイテムの配置を上から下に並べる*/
            height:calc(100vh - 50px); /*50pxだけ引いた残り全部*/
            margin: 0; /*デフォルトの余白を除去*/
            background-color:#F0F5F9;
        }
        h1 {
            text-align: center; /*テキストを水平方向に中央揃え*/
        }
        #content {
            display: flex;
            flex: 1; /*フレックスコンテナ内の空いているスペースを取得、コンテナより大きい場合は収縮*/
            margin-top:37px;
        }
        #image-list {
            width: 20%;
            padding: 10px;
            box-sizing: border-box; /*ボックスサイズがボーダー込みになる*/
            overflow-y: auto; /*要素内の内容が要素自体の高さを超えた場合スクロールバー表示*/
            border-right: 1px solid #ccc;
        }
        #image-list img {
            width: 100%;
            /*height: auto; /*画像の高さに自動調整*/
            aspect-ratio: 16 / 9; /*幅と高さの割合の設定*/
            object-fit: cover; /*要素のボックスにコンテンツを合わせる*/
        }
        #slideshow-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center; /*横の中央*/
            padding:15px 50px;
            box-sizing: border-box;
        }
        #slideshow img {
            max-width: 100%; /*親要素の幅マックス*/
            max-height: 100%; /*親要素の高さマックス*/
            aspect-ratio: 16 / 9;
            object-fit: cover;
            display:flex;
            justify-content:center;

        }
        .message{
            text-align:center;
            vertical-align: center;
        }
        .navigation {
            display: flex;
            justify-content: center;
        }
        .navigation button {
            background-color:#606060;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            color:white;
        }
        .navigation button:hover {
            background-color: gray;
        }
        .form-container {
            text-align: center;
            padding: 10px;
        }
        .form-container button {
            background-color: gray;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            color:white;
            border-radius:5px;
        }
        .form-container button:hover {
            background-color:#5a6268;
        }
        .btn-danger{
            background-color: rgba(255, 255, 255, 0.3);
            transition:all 0.5s;
            border-color:rgba(255, 255, 255, 0.3);
        }
        header {
            height:45px;
            width: 100%;
            background-color: rgba(34, 49, 52, 0.9);
            display: flex;
            align-items: center; /* 垂直方向の中央揃え */
            justify-content: space-between; /* 水平方向の中央揃え */

            box-sizing: border-box;
            color: white;
            position:fixed;
        }
        header p{
            color:white;
            font-size:30px;
            font-weight:bold;
            font-family: "Noto Serif", sans-serif;
            padding:20px 0 0 7px;

        }
        .logout-form {
            margin: 0;
            display: flex;
            align-items: center;
        }
        .logout-form button {
            background-color: rgba(255, 255, 255, 0.3);
            border: none;
            cursor: pointer;
            color: white;
            height:45px;
        }


    </style>

</head>
<header>
    <p>Preview</p>
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-sign-out-alt"></i> ログアウト
        </button>
    </form>
</header>
<body>



@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div id="content">
    <div id="image-list">
        <p>サイネージに表示する画像を選択できます</p>
        <form action="{{ route('preview.update') }}" method="POST">
            @csrf
            @foreach($files as $file)
                <div>
                    <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像（未選択）"
                        class="{{ $file->status == 1 ? 'checked' : '' }}">
                    <input type="checkbox" name="files[]" value="{{ $file->id }}"
                        {{ $file->status == 1 ? 'checked' : '' }}>
                </div>
        @endforeach
        <button type="submit" class="btn btn-success">変更を適用</button>
        </form>
        <!-- ニュースジャンル選択フォーム -->
        <form action="{{ route('fetch.news') }}" method="GET">
            <label for="category">ニュースジャンルを選択してください：</label>
            <select name="category" id="category">
                <option value="business">ビジネス</option>
                <option value="entertainment">エンターテイメント</option>
                <option value="general">一般</option>
                <option value="health">健康</option>
                <option value="science">科学</option>
                <option value="sports">スポーツ</option>
                <option value="technology">技術</option>
            </select>
            <button type="submit">表示</button>
        </form>
    </div>


    <div id="slideshow-container">
        <div id="selected-images">

            @php
                $hasSelectedImages = false;
            @endphp
            <div id="slideshow">
                @foreach($files as $file)
                    @if($file->status == 1)
                        @php
                            $hasSelectedImages = true;
                        @endphp
                        <div class="slide">
                            <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像（選択済み）">
                        </div>
                    @endif
                @endforeach
                    <div class="message">
                        @if(!$hasSelectedImages)
                            <p>画像が選択されていません</p>
                        @endif
                    </div>
            </div>
        </div>

        @if($hasSelectedImages)
            <div class="navigation">
                <button id="prev" title="前の写真">&lt;</button>
                <button id="next" title="次の写真">&gt;</button>
            </div>
        @endif
        <div class="form-container">
            <form action="{{ route('preview.backToUpload') }}" method="post">
                @csrf
                <button class="return-button" type="submit">画像アップロード画面に戻る</button>
            </form>
        </div>
    </div>
</div>



@if($hasSelectedImages)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let slides = document.querySelectorAll('#slideshow .slide');
        let currentSlide = 0;
        let intervalId;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = (i === index) ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        document.getElementById('next').addEventListener('click', function() {
            clearInterval(intervalId);
            nextSlide();
            startAutoSlide();
        });

        document.getElementById('prev').addEventListener('click', function() {
            clearInterval(intervalId);
            prevSlide();
            startAutoSlide();
        });

        function startAutoSlide() {
            intervalId = setInterval(nextSlide, 5000);
        }

        showSlide(currentSlide);
        startAutoSlide();
    });
</script>
@endif

</body>
</html>
