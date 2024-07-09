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
            top: 20px;
            left: 20px;
            color: white;
            font-size: 60px;
            font-weight: 300;
            font-family: 'cursive', serif;
            padding: 10px 20px;
            z-index: 2;
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

            setInterval(showNextImage, 3000);
        });

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}`;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
