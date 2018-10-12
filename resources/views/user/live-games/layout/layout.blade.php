@inject('gameService', "Models\Gaming\GameService")
<!DOCTYPE html>
<html>
<head>
    <title>&#9658; {{ $game->name }} - LIVE - {{ trans('app.meta.short_title') }}</title>
    <link rel="stylesheet" href="{{ asset("live-games/{$game->slug}/css/reset.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("live-games/{$game->slug}/css/main.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("live-games/{$game->slug}/css/orientation_utils.css") }}" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <meta name="msapplication-tap-highlight" content="no"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    @yield('head')

    <script>
        GAME_PATH = '/live-games/{{ $game->slug }}';
    </script>

    @yield('scripts')
</head>
<body ondragstart="return false;" ondrop="return false;" >
    <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>

    @yield('game')

    <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
</body>
</html>