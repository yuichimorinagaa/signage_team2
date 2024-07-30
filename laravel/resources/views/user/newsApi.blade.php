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
                url: '{{ route('fetch.news') }}',
                method: 'GET',
                success: function(data) {
                    console.log('Fetched Data:', data); // データをコンソールに出力して確認

                    if (data.error) {
                        $('#news-container').html('<p>' + data.error + '</p>');
                    } else {
                        var newsHtml = '';
                        data.forEach(function(newsItem) {
                            newsHtml += `
                            <div class="card-body pt-0 pb-2">
                                <h3 class="h5 card-title">
                                    <a href="${newsItem.url}" target="_blank">${newsItem.name}</a>
                                </h3>
                                <div class="card-text">
                                    ${newsItem.thumbnail ? '<img src="' + newsItem.thumbnail + '" alt="ニュースサムネイル">' : '<p>No Image</p>'}
                                </div>
                                <div>
                                    ${newsItem.description ? newsItem.description : 'No Description'}
                                </div>
                            </div>
                        `;
                        });
                        $('#news-container').html(newsHtml);
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

    document.addEventListener('DOMContentLoaded', function() {
        let currentNewsIndex = 0;
        let newsData = @json($news);

        function displayNews(index) {
            const newsItem = newsData[index];
            let newsHtml = `
                    <div class="card-image">
                        ${newsItem.urlToImage ? `<img src="${newsItem.urlToImage}" alt="ニュースサムネイル">` : '<p>No image available</p>'}
                    </div>
                    <h3 class="card-title">
                         <h>${newsItem.title}</h>
                    </h3>
                `;
            document.getElementById('news-container').innerHTML = newsHtml;
        }

        function rotateNews() {
            displayNews(currentNewsIndex);
            currentNewsIndex = (currentNewsIndex + 1) % newsData.length;
        }

        setInterval(rotateNews, 300000); // 5分ごとにニュースを変更
        rotateNews(); // 初回表示
    });
    <!--ニュースの更新終わり-->
</script>
</body>
</html>
