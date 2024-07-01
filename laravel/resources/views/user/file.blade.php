<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<h2>画像選択画面</h2>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="selectedCount">選択された画像: 0</div>


<form action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" >
    <input type="submit" class="btn btn-primary " value="投稿">
</form>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
    </div>
@endif

<div class="image-grid">
@foreach($files as $file)
    <div class="show_image_container">
        <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像の説明" class="clickable-image">
        <div class="button_array">
            <button class="btn btn-info select-image">選択</button>
            <form action="{{ route('file.delete',['id'=>$file->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ">削除</button>
            </form>
        </div>
    </div>
@endforeach
</div>



<!-- 大きな画像を表示するための領域（初期は非表示にしておく） -->
<div id="largeImageContainer" style="display: none;">
    <img src="" alt="Large Image" id="largeImage">
</div>
<!-- JavaScript -->

<script>
    // 画像をクリックしたときの処理
    document.querySelectorAll('.clickable-image').forEach(function(image) {
        image.addEventListener('click', function() {
            var largeImageContainer = document.getElementById('largeImageContainer');
            var largeImage = document.getElementById('largeImage');

            // クリックした画像のsrcを取得して大きな画像のsrcに設定する
            largeImage.src = this.src;

            // 大きな画像を表示する
            largeImageContainer.style.display = 'block';
        });
    });


    // 選択ボタンをクリックして選択する処理
    document.querySelectorAll('.select-image').forEach(function(selectButton) {
        selectButton.addEventListener('click', function() {
            toggleSelection(this.closest('.show_image_container')); // 親要素（.show_image_container）を選択状態にする
            updateSelectedCount(); // 選択された画像の数を更新する
        });
    });

    // 画像をクリックして選択状態を切り替える関数
    function toggleSelection(container) {
        container.classList.toggle('selected'); // 選択状態の切り替え
    }

    // 選択された画像の数を更新する関数
    function updateSelectedCount() {
        var selectedCount = document.querySelectorAll('.show_image_container.selected').length;
        document.getElementById('selectedCount').textContent = '選択された画像: ' + selectedCount;
    }

    // 大きな画像領域をクリックしたら非表示にする（オーバーレイを閉じる）
    document.getElementById('largeImageContainer').addEventListener('click', function() {
        this.style.display = 'none'; // 大きな画像を非表示にする
    });
</script>


<style>
    .image-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* 画像間の隙間 */
    }

    .button_array {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .show_image_container {
        width: 200px; /* 画像コンテナの幅を統一 */
        height: auto; /* 高さは自動調整 */
        margin-bottom: 10px; /* コンテナ間の余白を追加 */
    }

    .show_image_container img {
        width: 100%; /* 画像をコンテナ幅に合わせる */
        height: auto; /* 高さは自動調整 */
        cursor: pointer; /* カーソルをポインターに変更 */
        border: 2px solid transparent; /* 初期は透明な枠線 */
        transition: border-color 0.2s ease; /* 枠線の色が変わるアニメーション */
    }

    .show_image_container.selected img {
        border-color: blue; /* 選択された画像の枠線を青色にする */
    }

    #largeImageContainer {
        position: fixed; /* 画面中央に固定 */
        top: 50%; /* 上下中央に配置 */
        left: 50%; /* 左右中央に配置 */
        transform: translate(-50%, -50%); /* 中央揃え */
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999; /* 最前面に表示 */
        display: none; /* 初期は非表示 */
    }

    #largeImage {
        max-width: 100%; /* 大きな画像をコンテナ幅に合わせる */
        height: auto; /* 高さは自動調整 */
        cursor: pointer; /* カーソルをポインターに変更 */
    }

    body h2 span {
        display: block;
        text-align: center;
    }
</style>
</body>
</html>
