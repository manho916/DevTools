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
        <div class="action-wrap">
            <div class="action-left">
                @if(!empty($prev))
                <a href="{{ $prev }}"><div class="btn">PREV</div></a>
                @else
                <div class="btn grey">PREV</div>
                @endif
            </div>
            <div class="action-right">
                @if(!empty($next))
                <a href="{{ $next }}"><div class="btn">NEXT</div></a>
                @else
                <div class="btn grey">NEXT</div>
                @endif
            </div>
        </div>
        <div>
            <a href="{{ $channelUrl }}"><div class="btn btn_l mh-auto">Channel Info</div></a>
        </div>
        @foreach ($data as $idx => $items)
            <div class="search-table">
                <div class="search-table-header">{{ $idx }} - {{ $items['title'] }} - {{ $items['viewCount'] }}</div>
                <div class="search-table-content">
                @foreach($items as $attr => $val)
                    @if($attr == "thumbnail")
                    <div class="search-table-content-container">
                        <div class="search-table-content-item w-3"></div>
                        <div class="search-table-content-item w-9">
                            <img src="{{ $val['url'] }}" width="{{ $val['width'] }}" height="{{ $val['height'] }}" >
                        </div>
                    </div>
                    @elseif($attr == "url")
                    <div class="search-table-content-container">
                        <div class="search-table-content-item w-3">{{ $attr }}</div>
                        <div class="search-table-content-item w-9">
                            <a href="{{ $val }}">{{ $val }}</a>
                        </div>
                    </div>
                    @else
                    <div class="search-table-content-container">
                        <div class="search-table-content-item w-3">{{ $attr }}</div>
                        <div class="search-table-content-item w-9">{{ $val }}</div>
                    </div>
                    @endif
                @endforeach
                </div>


            </div><br>
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
