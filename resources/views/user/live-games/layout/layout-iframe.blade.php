<!DOCTYPE html>
<html>
<head>
    <title>&#9658; {{ $game->name }} - LIVE - {{ trans('app.meta.short_title') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <style>
        body {
            margin: 0;
        }
    </style>


    <script>
        window.addEventListener('load', () => sessionStorage.setItem('session', '{!! $sessionData !!}'));
        window.addEventListener('load', () => sessionStorage.setItem('game', '{!! $gameData !!}'));
    </script>
</head>
<body>
    <iframe allowfullscreen src="{{ route('home') }}/live-games/{{ $game->slug }}/index.html" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;"></iframe>
</body>
</html>