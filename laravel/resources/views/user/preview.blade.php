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


    </style>

</head>
<header>
    <div>
        <div class="header-left">
            <p>Preview</p>
        </div>
        <div class="header-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fa-solid fa-sign-out-alt"></i> ログアウト
                </button>
            </form>
        </div>
    </div>
</header>
<body>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-xs-3" id="image-list">
            <h3>アップロードした画像</h3>
            <p>サイネージの背景に設定する画像を選択してください</p>
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
                <button type="submit">使用</button>
            </form>
        </div>



        <div class="col-xs-9" id="slideshow-container">
            <div id="selected-images">
                <h3>使用する画像</h3>
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
                    <button id="prev">&lt;</button>
                    <button id="next">&gt;</button>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('preview.backToUpload') }}" method="post">
        @csrf
        <button type="submit">画像アップロード画面に戻る</button>
    </form>
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
