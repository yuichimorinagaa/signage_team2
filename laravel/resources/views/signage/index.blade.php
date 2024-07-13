<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
        }

        .main-image {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            background-color: black;
        }

        .main-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .clock {
            position: absolute;
            top: 10px;
            left: 20px;
            color: white;
            font-size: 85px;
            font-weight: 300;
            font-family: 'cursive', serif;
            padding: 10px 20px;
            z-index: 2;
        }

        .weather {
            position: absolute;
            top: 150px;
            left: 20px;
            width: 15%;
            border-radius: 5%;
            background-color: rgba(36, 139, 255, 0.5);
            color: white;
            display: flex;
            z-index: 2;
        }

        .weather-top {
            text-align: center;
            flex: 0 0 50%;
            padding: 10px;
        }

        .weather-info{
            flex: 1;
            padding-top: 30px;
            flex-direction: column;
            justify-content: space-evenly;
        }


        .profile{
            position: absolute;
            top: 300px;
            right: 100px;
            width: 40%;
            height: 30%;
            border: solid 2px;
            border-radius: 5%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            z-index: 3;
        }

        .profile-top{
            flex: 0 0 50%;
        }

        .profile-top img {
            width: 80%;
            height: 80%;
            margin-top: -20px;
            margin-bottom: -20px;
        }

        .name{
            width: 80%;
            text-align: center;
            margin-top: -20px;
        }

        .profile-info{
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            text-align: left;
            padding: 10px;
            box-sizing: border-box;
        }

        .profile-info p{
            margin: 0;
            line-height: 1.5;
            font-size: 1vw;
        }

        .profile-info > div {
            display: none;
        }

        .profile-info > .visible {
            display: block;
        }


    </style>
</head>
<body>
    <div class="main-image">
        <div class="clock" id="clock"></div>
        @foreach($images as $image)
            <img src="{{ asset('storage/image/' .$image->file_path) }}" alt="">
        @endforeach
    </div>

    <!-- 天気の表示-->
    <div id="weather-info" class="weather">
        <!-- 天気情報をここに表示 -->
    </div>
    <!-- 天気の表示終わり-->
    <!-- 自己紹介カードの表示 -->
    <div class="profile">
        <div class="profile-top">
            <div class="image">
                <img id="profile-photo" src="" alt="Profile Photo">
            </div>
            <div class="name">
                <h1 id="profile-name"></h1>
            </div>
        </div>
        <div class="profile-info">
            <div class="first-info">
                <p><strong>⭐️学年:</strong>&emsp;<span id="profile-grade"></span></p>
                <p><strong>⭐️大学:</strong>&emsp;<span id="profile-university"></span></p>
                <p><strong>⭐️入社日:</strong>&emsp;<span id="profile-joining-date"></span></p>
                <p><strong>⭐️趣味:</strong>&emsp;<span id="profile-hobbies"></span></p>
                <p><strong>⭐️MBTI:</strong>&emsp;<span id="profile-mbti"></span></p>
            </div>
            <div class="second-info">
                <p><strong>⭐️高校:</strong>&emsp;<span id="profile-high-school"></span></p>
                <p><strong>⭐️出身地:</strong>&emsp;<span id="profile-hometown"></span></p>
                <p><strong>⭐️誕生日:</strong>&emsp;<span id="profile-birthday"></span></p>
                <p><strong>⭐️座右の銘:</strong>&emsp;<span id="profile-motto"></span></p>
                <p><strong>⭐️ひようらの推し:</strong>&emsp;<span id="profile-restaurants"></span></p>
            </div>
            <div class="third-info">
                <p><strong>⭐️部活・サークル:</strong>&emsp;<span id="profile-club-activities"></span></p>
                <p><strong>⭐️好きな芸能人:</strong>&emsp;<span id="profile-famous-person"></span></p>
                <p><strong>⭐️音楽:</strong>&emsp;<span id="profile-artists"></span></p>
                <p><strong>⭐️もし私が社長なら、、:</strong>&emsp;<span id="profile-if-ceo"></span></p>
                <p><strong>⭐️コメント:</strong>&emsp;<span id="profile-comment"></span></p>
            </div>
        </div>
        <!-- 自己紹介カードの表示終わり -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentIndex = 0;
            const images = document.querySelectorAll('.main-image img');
            const totalImages = images.length;

            function showNextImage() {
                images[currentIndex].style.display = 'none';
                currentIndex = (currentIndex + 1) % totalImages;
                images[currentIndex].style.display = 'block';
            }

            images.forEach((img, index) => {
                img.style.display = index === 0 ? 'block' : 'none';
            });

            setInterval(showNextImage, 60000);
        });

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}`;
        }

        setInterval(updateClock, 1000);
        updateClock();

        <!-- 天気の表示 -->
        $(document).ready(function() {
            function fetchWeatherData() {
                $.ajax({
                    url: '{{ route('fetch.weather') }}', // APIデータ取得のURL
                    method: 'GET',
                    success: function(data) {
                        if (data.error) {
                            $('#weather-info').html('<p>' + data.error + '</p>');
                        } else {
                            $('#weather-info').html(`
                                <div class="weather-top">
                                    <p> ${data.description}</p>
                                    <p><img src="http://openweathermap.org/img/wn/${data.icon}@2x.png" alt="Weather Icon"></p>
                                </div>
                                <div class="weather-info">
                                    <p>🌡️ ${data.temperature}°C</p>
                                    <p>💧 ${data.humidity}%</p>
                                    <p>༄ ${data.wind_speed} m/s</p>
                                </div>
                            `);
                        }
                    },
                    error: function() {
                        $('#weather-info').html('<p>Failed to fetch weather data.</p>');
                    }
                });
            }

            setInterval(fetchWeatherData, 300000); // 5分ごとにデータを取得
            fetchWeatherData(); // 初回データ取得
        });
        <!-- 天気の表示終わり -->

        document.addEventListener("DOMContentLoaded", function() {
            let profiles = @json($profiles);

            profiles = profiles.map(profile => {
                return {
                    ...profile,
                    profile_photo_path: "{{ asset('storage') }}/" + profile.profile_photo_path
                };
            });


            let currentIndex = 0;
            let currentSectionIndex = 0;
            const sections = document.querySelectorAll('.profile-info > div');
            sections[currentSectionIndex].classList.add('visible');

            function showProfile(index) {
                let profile = profiles[index];
                document.getElementById('profile-photo').src = profile.profile_photo_path;
                document.getElementById('profile-name').textContent = profile.name;
                document.getElementById('profile-grade').textContent = profile.grade;
                document.getElementById('profile-university').textContent = profile.university;
                document.getElementById('profile-joining-date').textContent = profile.joining_date;
                document.getElementById('profile-comment').textContent = profile.comment;
                document.getElementById('profile-hobbies').textContent = profile.hobbies;
                document.getElementById('profile-mbti').textContent = profile.mbti;
                document.getElementById('profile-high-school').textContent = profile.high_school;
                document.getElementById('profile-hometown').textContent = profile.hometown;
                document.getElementById('profile-birthday').textContent = profile.birthday;
                document.getElementById('profile-motto').textContent = profile.motto;
                document.getElementById('profile-restaurants').textContent = profile.restaurants;
                document.getElementById('profile-club-activities').textContent = profile.club_activities;
                document.getElementById('profile-famous-person').textContent = profile.famous_person;
                document.getElementById('profile-artists').textContent = profile.artists;
                document.getElementById('profile-if-ceo').textContent = profile.if_ceo;
            }

            function rotateProfiles() {
                showProfile(currentIndex);
                currentIndex = (currentIndex + 1) % profiles.length;
            }

            function rotateSections() {
                sections[currentSectionIndex].classList.remove('visible');
                currentSectionIndex = (currentSectionIndex + 1) % sections.length;
                sections[currentSectionIndex].classList.add('visible');
            }

            setInterval(rotateProfiles, 30000); // 15秒ごとにプロフィールを変更
            setInterval(rotateSections, 10000)
            rotateProfiles(); // 初期表示

        });
    </script>
</body>
</html>
