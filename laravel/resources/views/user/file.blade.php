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
    <!-- FontAwesomeの読み込み -->
    <link href="https://use.fontawesome.com/releases/v6.5.2/css/all.css" rel="stylesheet">
    <!-- jqueryの読み込み　-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>
<header>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-sign-out-alt"></i> ログアウト
        </button>
    </form>
    <p>File Upload</p>
</header>
<body>



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<div class="container">
    <div class="selectedCount" id="selectedCount">選択された画像: 0</div>
    <div class="form-group" >
        <form action="{{route('file.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label class="upload_file btn btn-primary">
                <input  type="file" name="file" >
                <i class="fa-regular fa-file-image"></i>ファイルを選択
            </label>
            <p>選択されていません</p>
            <button type="submit" class="btn btn-primary upload">
                <i class="fa-solid fa-upload"></i>アップロード
            </button>
        </form>
        <form action="{{ route('file.statusChange') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="selected_files" id="selectedFilesInput">
            <button type="submit" class="btn btn-primary">
                <i class="fa-regular fa-circle-play"></i>プレビュー
            </button>
        </form>
    </div>
    <div class="clear"></div>
</div>


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
        <div class="show_image_container" data-file-id="{{ $file->id }}">

            <img src="{{ asset('storage/image/' . $file->file_path) }}" alt="画像の説明" class="clickable-image">
            <div class="button_array">



                <form action="{{ route('file.select') }}" method="POST">
                    @csrf
                    <!-- ボタンを通常のボタンとして扱う -->
                    <button type="button" class="btn btn-info select-image">
                        {{ $file->status == 0 ? '選択' : '選択解除' }}
                    </button>
                    <!-- 選択されたファイルのIDを隠しフィールドで送信 -->
                    <input type="hidden" name="selected_files[]" value="{{ $file->id }}">
                </form>
                <form action="{{ route('file.delete',['id'=>$file->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button title="削除" type="submit" class="delete_button"><i class="fa-solid fa-circle-minus"></i></button>
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
            updateSelectedFilesInput(); // 選択された画像のIDを更新する
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

    function updateSelectedFilesInput() {
        var selectedFiles = [];
        document.querySelectorAll('.show_image_container.selected').forEach(function(container) {
            selectedFiles.push(container.dataset.fileId); // data-file-id属性からファイルIDを取得
        });
        document.getElementById('selectedFilesInput').value = selectedFiles.join(','); // カンマ区切りの文字列に変換してhidden inputに設定
    }

    // 大きな画像領域をクリックしたら非表示にする（オーバーレイを閉じる）
    document.getElementById('largeImageContainer').addEventListener('click', function() {
        this.style.display = 'none'; // 大きな画像を非表示にする
    });
    //jQueryで選択したファイルパスを表示//
    $('input').on('change', function () {
        var file = $(this).prop('files')[0];
        $('p').text(file.name);
    });
</script>


<style>
    body{
        background-color:#F0F5F9;
    }

    .image-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* 画像間の隙間 */
        margin-top:50px;
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
        position:relative;
    }

    .show_image_container img {
        width: 100%; /* 画像をコンテナ幅に合わせる */
        height: auto; /* 高さは自動調整 */
        cursor: pointer; /* カーソルをポインターに変更 */
        border: 3px solid transparent; /* 初期は透明な枠線 */
        transition: border-color 0.2s ease; /* 枠線の色が変わるアニメーション */
    }

    .show_image_container.selected img {
        border-color: blue; /* 選択された画像の枠線を青色にする */
        filter: brightness(80%); /* 画像を少し暗くする */
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
    .delete_button{
        border:none; /*ボタンの枠線を消去*/
        background:none; /*ボタンの背景を消去*/
        position: absolute; /* 絶対位置 */
        top: -26px; /* 上外に配置 */
        right: -20px; /* 右外に配置 */
        padding: 5px; /* 余白 */
        cursor:pointer; /* カーソルをポインターに */
        font-size:20px;
        color:red;
    }
    .select-image{
        color:white;
    }
    .form-group{
        display:flex;
        align-items:center;
        gap:10px;
    }

    .fa-upload{
        margin-right:5px;
    }
    .upload{
        margin:0 5px;
    }
    .selectedCount{
        float: left;
        margin-right:auto;
        font-size:20px;
    }

    .container{
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin-top:10px;
    }

    .fa-circle-play{
        margin:5px;
    }
    input[type="file"]{
        display:none;
    }
    .upload_file{
        cursor:pointer;

    }
    .form-group form {
        display: flex; /* 内部のフォームもFlexコンテナとして設定 */
        align-items: center; /* 垂直方向に中央揃え */
        gap: 10px; /* 要素間の隙間 */
    }
    .btn-primary{
        background-color:dodgerblue;

    }
    .btn-danger{
        float:right;
        background-color: rgba(255, 255, 255, 0.3);
        transition:all 0.5s;
        border:none;
        height:45px;
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
        padding:20px 0 0 7px;

    }
    .fa-regular{
        margin-right:5px;
    }

</style>
</body>
</html>
