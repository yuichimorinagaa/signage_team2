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
<h1>プレビュー</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div>
    <h3>画像一覧</h3>
    <form action="{{ route('preview.update') }}" method="POST">
        @csrf
        @foreach($files as $file)
            <div>
                <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像の説明"
                    class="{{ $file->status == 1 ? 'checked' : '' }}">
                <input type="checkbox" name="files[]" value="{{ $file->id }}"
                    {{ $file->status == 1 ? 'checked' : '' }}>
            </div>
      @endforeach
      <button type="submit">使用</button>
    </form>
</div>

<div id="selected-images">
    <h3>選択された画像</h3>
    <div id="slideshow">
        @foreach($files as $file)
            @if($file->status == 1)
                <div class="slide">
                    <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="選択された画像">
                </div>
            @endif
        @endforeach
    </div>

</div>

<div>
    <form action="{{ route('preview.backToUpload') }}" method="post">
        @csrf
        <button type="submit">やり直す</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let slides = document.querySelectorAll('#slideshow .slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = (i === index) ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        showSlide(currentSlide);
        setInterval(nextSlide, 5000);
    });
</script>

<style>
    #slideshow .slide {
        display: none;
    }
</style>

</body>
</html>
