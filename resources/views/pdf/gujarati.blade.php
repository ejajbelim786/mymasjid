<!DOCTYPE html>

<html lang="gu">

<head>

    <meta charset="UTF-8">

    <title>{{ $title }}</title>

    <style>

        @font-face {
            font-family: 'Noto Sans Gujarati';
            src: url('{{ public_path("storage/fonts/NotoSansGujarati-Regular.ttf") }}') format('truetype');
        }
        

        body {

            font-family: 'Noto Sans Gujarati', sans-serif;

        }

    </style>

</head>

<body>

    <h1>{{ $title }}</h1>

    <p>{{ $content }}</p>

</body>

</html>

