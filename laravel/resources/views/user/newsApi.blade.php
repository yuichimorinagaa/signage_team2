<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ニュース</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container ">
    @foreach($news as $data)
        <div class="card-body pt-0 pb-2">
            <div>
                {{$data['description']}}
            </div>
            <h3 class="h5 card-title">
                <a href="{{$data['url']}}">{{$data['name']}}</a>
            </h3>
            <div class="card-text">
                <img src="{{$data['thumbnail']}}">
            </div>

        </div>
    @endforeach
</div>
<div id="news-container">

</div>

<script>
    $(document).ready(function() {
        function fetchNewsData() {
            $.ajax({
                url: '{{ route('fetch.news') }}', // APIデータ取得のURL
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        $('#news-container').html('<p>' + data.error + '</p>');
                    } else {
                        // ニュースデータをコンテナーに追加
                        $('#news-container').html(`
                            <div class="card-body pt-0 pb-2">
                                <h3 class="h5 card-title">
                                    <a href="${data.url}" target="_blank">${data.name}</a>
                                </h3>
                                <div class="card-text">
                                    <img src="${data.thumbnail}" alt="ニュースサムネイル">
                                </div>
                                <div>
                                    ${data.description}
                                </div>
                            </div>
                        `);
                    }
                },
                error: function() {
                    $('#news-container').html('<p>ニュースデータの取得に失敗しました。</p>');
                }
            });
        }

        setInterval(fetchNewsData, 300000); // 5分ごとにデータを取得
        fetchNewsData(); // 初回データ取得
    });
</script>
</body>
</html>
