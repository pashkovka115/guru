<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
<h1>{{ env('APP_NAME') }}</h1>
<div class="container">
    <p>От: {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Телефон: {{ $data['phone'] }}</p>
    <p>{{ $data['message'] }}</p>
</div>
</body>
</html>

