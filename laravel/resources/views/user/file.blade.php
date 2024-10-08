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
    <div class="header-left">
        <p>File Upload</p>
    </div>
    <div class="header-right">
        <div class="usage">
            <button onclick="toggleInstructions()" class="btn btn-success usage-btn"><i class="fa-regular fa-circle-question"></i>使い方</button>
            <div id="usage-content" class="usage-instructions">
                <ol class="usage_container">
                    <li><span class="file-usage"><i class="fa-regular fa-file-image"></i>ファイル選択</span>アップロードしたい画像を選択</li>
                    <li><span class="upload-usage"><i class="fa-solid fa-upload"></i>アップロード</span>画像をアップロード</li>
                    <li>サイネージに表示させる画像を選択(複数選択可)</li>
                    <li><i class="fa-solid fa-circle-plus"></i>選択　<i class="fa-regular fa-circle-xmark"></i>選択解除　<i class="fa-solid fa-circle-minus"></i>画像を削除</li>
                    <li><span class="preview-usage"><i class="fa-regular fa-circle-play"></i>プレビュー</span>プレビュー画面へ</li>
                </ol>
            </div>

        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-sign-out-alt"></i> ログアウト
            </button>
        </form>
    </div>
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
            <p id="file-name">選択されていません</p>
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
                    <button type="button" class="select-image choice" title="選択">
                        <i class="fa-solid fa-circle-plus"></i>
                    </button>
                    <!-- 選択されたファイルのIDを隠しフィールドで送信 -->
                    <input type="hidden" name="selected_files[]" value="{{ $file->id }}">
                </form>
                @if ($file->user_id == Auth::id())
                    <form action="{{ route('file.delete',['id'=>$file->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button title="削除" type="submit" class="delete_button"><i class="fa-solid fa-circle-minus"></i></button>
                    </form>
                @endif
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


    document.addEventListener('DOMContentLoaded', function() {
        // 全ての .select-image ボタンに対してクリックイベントを設定
        document.querySelectorAll('.select-image').forEach(function(selectButton) {
            selectButton.addEventListener('click', function() {
                // 親要素の .show_image_container を取得
                const container = this.closest('.show_image_container');

                // 選択状態を切り替える
                container.classList.toggle('selected');
                updateSelectedCount(); // 選択された画像の数を更新する
                updateSelectedFilesInput(); // 選択された画像のIDを更新する
                // ボタンのラベルを切り替える
                if (container.classList.contains('selected')) {
                    this.innerHTML ='<i class="fa-regular fa-circle-xmark"></i>'; // 選択解除のラベルに変更
                } else {
                    this.innerHTML = '<i class="fa-solid fa-circle-plus"></i>'; // 選択のラベルに変更
                }
            });
        });
    });


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
        $('#file-name').text(file.name);
    });
    function toggleInstructions() {
        var instructions =document.getElementById('usage-content');
        if (instructions.style.display ==='none'){
            instructions.style.display = 'block';
            document.querySelector('button');
        }else{
            instructions.style.display = 'none';
            document.querySelector('button');
        }
    }
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
        padding:0 10px;
    }

    .button_array {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .show_image_container {
        width: 200px; /* 画像コンテナの幅を統一 */
        height: auto; /* 高さは自動調整 */
        margin:0 10px 10px 15px; /* コンテナ間の余白を追加 */
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
    .choice{
        border:none;
        background: none;
        position:absolute;
        top:-26px;
        left:-20px;
        padding:5px;
        cursor:pointer;
        font-size:20px;
        color:dodgerblue !important;
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
        margin-left:5px;
    }
    .header-left{
        float:left;
    }
    .header-right{
        float:right;
        display:flex;

    }
    .fa-regular{
        margin-right:5px;
    }

    .usage-instructions{
        display:none;
        position:absolute;
        z-index:1000;
        border:1px solid #ccc;
        background-color:#F0F5F9;

    }
    .btn-success{
        height:45px;
        cursor:pointer;
        margin-right:5px;
    }
    .fa-circle-xmark{
        border:none;
        background:none;
        color:dodgerblue;


    }
    .fa-circle-minus{
        color:red;
    }
    .fa-circle-plus{
        color:dodgerblue;
    }
    li{
        padding-bottom: 5px;
    }
    li span{
        color:white;
        background-color:dodgerblue;
        border-radius:0.375rem;
        border-color:dodgerblue;
        padding:2px;
    }
    #usage-content{
        position:absolute;
        left:-130px;
        width:332px;
        border-radius:5px;
        padding:5px;
    }
    .usage{
        position:relative;
    }



</style>
</body>
</html>
