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
        function checkSettings(settings) {
            $.get('{{ route('user.session.check_settings', ['game' => $game]) }}', {
                token: '{{ $token }}',
                settings: settings
            }, function (response) {
                if (response !== 'ok') {
                    window.location.href = '{{ route('user.game.manage_session', ['slug' => $game->slug]) }}';
                }
            });
        }
        
        function closeGameSession() {
            $.get('{{ route('user.session.close_ajax', ['game' => $game]) }}', function(response) {
                if (response !== 'ok') {
                    alert('{{ trans('frontend/game.session_not_closed_properly') }}');
                    window.location.href = '{{ route('user.game.manage_session', ['slug' => $game->slug]) }}';
                }

                // By default, when the game does not detect an open session. The check token method will auto-redirect...
                // So nothing else to do here
            });
        }

        function redirectOnRecharge() {
            //alert('{{ trans('frontend/game.out_of_money') }}');
            window.location.href = '{{ route('user.game.manage_session', ['slug' => $game->slug]) }}';
        }

        function registerResult(credits) {
            $.get('{{ route('user.session.save_credits', ['game' => $game]) }}', {
                token: '{{ $token }}',
                credits: credits,
                settings: gameSettings
            }, function (response) {
                if (response !== 'ok') {
                    window.location.href = '{{ route('user.game.manage_session', ['slug' => $game->slug]) }}';
                }
            });
        }

        GAME_PATH = '/live-games/{{ $game->slug }}';
    </script>

    @yield('scripts')
</head>
<body ondragstart="return false;" ondrop="return false;" >
    <div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>

    @yield('game')

    <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>


    <script>
        $(document).ready(function() {
            setInterval(function() {
                if (typeof gameSettings !== 'undefined') {
                    checkSettings(gameSettings);
                }
            }, 1000);
        });
    </script>
</body>
</html>