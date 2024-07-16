<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #75A9FF;
        }

        .profile{
            position: absolute;
            top: 100px;
            left: 600px;
            width: 40%;
            height: 30%;
            border: solid 2px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
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
    <script>
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

            setInterval(rotateProfiles, 15000); // 15秒ごとにプロフィールを変更
            setInterval(rotateSections, 5000)
            rotateProfiles(); // 初期表示

        });
    </script>
</head>
<body>
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
</div>


</body>
</html>
