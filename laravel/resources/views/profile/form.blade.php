<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>自己紹介入力フォーム</title>
    <style>
        body {
            background-color: #F0F5F9;
            font-family:'serif';
        }
        h1 {
            text-align: center;
            padding-top: 20px;
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #343a40;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
        }
        .form-group {
            margin: 15px 0;
        }
        label {
            font-weight: bold;
            color: #495057;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            font-size: 1rem;
            border-radius: 5px;
        }
        .form-control-file {
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.2rem;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>自己紹介入力フォーム</h1>
<div class="container mt-5">
    <div class="card">
        <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">氏名:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="grade">学年:<span style="color: red;">※</span></label>
                <select class="form-control" id="grade" name="grade" required>
                    <option value="">選択してください</option>
                    <option value="大学1年">大学1年</option>
                    <option value="大学2年">大学2年</option>
                    <option value="大学3年">大学3年</option>
                    <option value="大学4年">大学4年</option>
                    <option value="修士1年">修士1年</option>
                    <option value="修士2年">修士2年</option>
                </select>
            </div>
            <div class="form-group">
                <label for="university">大学:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="university" name="university" required>
            </div>
            <div class="form-group">
                <label for="profile_photo_path">プロフィール写真:</label>
                <input type="file" class="form-control-file" id="profile_photo_path" name="profile_photo_path">
            </div>
            <div class="form-group">
                <label for="joining_date">入社日:<span style="color: red;">※</span></label>
                <input type="date" class="form-control" id="joining_date" name="joining_date" required>
            </div>
            <div class="form-group">
                <label for="hobbies">趣味:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="hobbies" name="hobbies" required>
            </div>
            <div class="form-group">
                <label for="mbti">MBTI:<span style="color: red;">※</span></label>
                <select class="form-control" id="mbti" name="mbti" required>
                    <option value="">選択してください</option>
                    <option value="INTJ">INTJ</option>
                    <option value="INTP">INTP</option>
                    <option value="ENTJ">ENTJ</option>
                    <option value="ENTP">ENTP</option>
                    <option value="INFJ">INFJ</option>
                    <option value="INFP">INFP</option>
                    <option value="ENFJ">ENFJ</option>
                    <option value="ENFP">ENFP</option>
                    <option value="ISTJ">ISTJ</option>
                    <option value="ISFJ">ISFJ</option>
                    <option value="ESTJ">ESTJ</option>
                    <option value="ESFJ">ESFJ</option>
                    <option value="ISTP">ISTP</option>
                    <option value="ISFP">ISFP</option>
                    <option value="ESTP">ESTP</option>
                    <option value="ESFP">ESFP</option>
                    <option value="分からない">分からない</option>
                </select>
            </div>
            <div class="form-group">
                <label for="high_school">出身高校:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="high_school" name="high_school" required>
            </div>
            <div class="form-group">
                <label for="hometown">〇〇生まれ〇〇育ち:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="hometown" name="hometown" required>
            </div>
            <div class="form-group">
                <label for="birthday">誕生日:<span style="color: red;">※</span></label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
            <div class="form-group">
                <label for="motto">座右の銘:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="motto" name="motto" required>
            </div>
            <div class="form-group">
                <label for="restaurants">ひようらで一番好きな店:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="restaurants" name="restaurants" required>
            </div>
            <div class="form-group">
                <label for="club_activities">入ってる（入ってた）部活・サークル:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="club_activities" name="club_activities" required>
            </div>
            <div class="form-group">
                <label for="famous_person">好きな芸能人:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="famous_person" name="famous_person" required>
            </div>
            <div class="form-group">
                <label for="artists">よく聴くアーティスト:<span style="color: red;">※</span></label>
                <input type="text" class="form-control" id="artists" name="artists" required>
            </div>
            <div class="form-group">
                <label for="if_ceo">もし私がSDBの社長だったら...:<span style="color: red;">※</span></label>
                <textarea class="form-control" id="if_ceo" name="if_ceo" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="comment">みんなにメッセージ！:<span style="color: red;">※</span></label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
</div>
</body>
</html>
