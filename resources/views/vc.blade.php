<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link rel="stylesheet" href="/css/reset.css?{{ time() }}">
    <link rel="stylesheet" href="/css/main.css?{{ time() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>

    </style>
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <div class="content">

        @foreach ($data as $key => $val)
            {{ $key }} => {{ $val['title'] }} <br>
        @endforeach

    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.search-table-header').on('click', function(){
            var content = $(this).parent().find('.search-table-content');
            content.slideToggle(100);
        });

    })

</script>
</html>
