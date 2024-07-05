<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .profile {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .profile img {
            max-width: 50%;
            height: auto;
            border-radius: 50%;
        }
        .image {
            text-align: center;
        }
        .name {
            text-align: center;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let profiles = @json($profiles);
            profiles = profiles.map(profile => {
                return {
                    ...profile,
                    profile_photo_path: "{{ asset('storage/profile_photo') }}/" + profile.profile_photo_path
                };
            });


            let currentIndex = 0;

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

            setInterval(rotateProfiles, 30000); // 30秒ごとにプロフィールを変更
            rotateProfiles(); // 初期表示
        });
    </script>
</head>
<body>
<div class="profile">
    <div class="image">
        <img id="profile-photo" src="" alt="Profile Photo">
    </div>
    <div class="name">
        <h1 id="profile-name"></h1>
    </div>
    <p><strong>学年:</strong> <span id="profile-grade"></span></p>
    <p><strong>大学:</strong> <span id="profile-university"></span></p>
    <p><strong>入社日:</strong> <span id="profile-joining-date"></span></p>
    <p><strong>趣味:</strong> <span id="profile-hobbies"></span></p>
    <p><strong>MBTI:</strong> <span id="profile-mbti"></span></p>
    <p><strong>出身高校:</strong> <span id="profile-high-school"></span></p>
    <p><strong>〇〇生まれ〇〇育ち:</strong> <span id="profile-hometown"></span></p>
    <p><strong>誕生日:</strong> <span id="profile-birthday"></span></p>
    <p><strong>座右の銘:</strong> <span id="profile-motto"></span></p>
    <p><strong>好きなひようらのお店:</strong> <span id="profile-restaurants"></span></p>
    <p><strong>入ってる（入ってた）部活・サークル:</strong> <span id="profile-club-activities"></span></p>
    <p><strong>好きな芸能人:</strong> <span id="profile-famous-person"></span></p>
    <p><strong>よく聴くアーティスト:</strong> <span id="profile-artists"></span></p>
    <p><strong>もし私がSDBの社長だったら...:</strong> <span id="profile-if-ceo"></span></p>
    <p><strong>コメント:</strong> <span id="profile-comment"></span></p>
</div>


</body>
</html>
