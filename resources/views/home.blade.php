<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link rel="stylesheet" href="/css/reset.css?{{ time() }}">
    <link rel="stylesheet" href="/css/main.css?{{ time() }}">
    <style>
        .content{
            margin-left: 200px;
        }
    </style>
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <div class="content">
        @foreach ($data as $key => $val)
            {{ $key }} {{ $val }} <br>
        @endforeach
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
