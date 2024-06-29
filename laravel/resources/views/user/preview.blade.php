<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        h1 {
            text-align: center;
        }
        #content {
            display: flex;
            flex: 1;
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
        #slideshow-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            box-sizing: border-box;
        }
        #slideshow {
            width: 100%;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
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
    </style>

</head>
<body>

<header>
    <h1>プレビュー画面</h1>
</header>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div id="content">
    <div id="image-list">
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


    <div id="slideshow-container">
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
