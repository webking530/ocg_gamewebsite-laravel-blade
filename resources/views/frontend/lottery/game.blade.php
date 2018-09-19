<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OCG Lottery</title>

    <meta name="description" content="OCG Lottery">
    <meta name="keywords" content="lottery">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement("style");
            msViewportStyle.appendChild(
                document.createTextNode(
                    "@-ms-viewport{width:device-width}"
                )
            );
            document.getElementsByTagName("head")[0].
            appendChild(msViewportStyle);
        }
    </script>

    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('lottery-game/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('lottery-game/css/main.css') }}">

    <script src="{{ asset('lottery-game/js/vendor/modernizr-2.6.2.min.js') }}"></script>
</head>
<body>
<!-- PERCENT LOADER START-->
<div id="mainLoader"><img src="{{ asset('lottery-game/assets/loader.png') }}" /><br><span>0</span></div>
<!-- PERCENT LOADER END-->

<!-- CONTENT START-->
<div id="mainHolder">

    <!-- BROWSER NOT SUPPORT START-->
    <div id="notSupportHolder">
        <div class="notSupport">YOUR BROWSER ISN'T SUPPORTED.<br/>PLEASE UPDATE YOUR BROWSER IN ORDER TO RUN THE GAME</div>
    </div>
    <!-- BROWSER NOT SUPPORT END-->

    <!-- ROTATE INSTRUCTION START-->
    <div id="rotateHolder">
        <div class="mobileRotate">
            <div class="rotateDesc">
                <div class="rotateImg"><img src="{{ asset('lottery-game/assets/rotate.png') }}" /></div>
                Rotate your device <br/>to landscape
            </div>
        </div>
    </div>
    <!-- ROTATE INSTRUCTION END-->

    <!-- CANVAS START-->
    <div id="canvasHolder">
        <canvas id="gameCanvas" width="1280" height="768"></canvas>
    </div>
    <!-- CANVAS END-->

</div>
<!-- CONTENT END-->

<script src="{{ asset('lottery-game/js/vendor/jquery-1.12.4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Define vars for numbers here
        LOTTERY_NUMBERS = {{ $winningNumber }};
    });
</script>

<script src="{{ asset('lottery-game/js/vendor/detectmobilebrowser.js') }}"></script>
<script src="{{ asset('lottery-game/js/vendor/createjs-2015.11.26.min.js') }}"></script>
<script src="{{ asset('lottery-game/js/vendor/TweenMax.min.js') }}"></script>
<script src="{{ asset('lottery-game/js/vendor/p2.min.js') }}"></script>

<script src="{{ asset('lottery-game/js/plugins.js') }}"></script>
<script src="{{ asset('lottery-game/js/sound.js') }}"></script>
<script src="{{ asset('lottery-game/js/canvas.js') }}"></script>
<script src="{{ asset('lottery-game/js/p2.js') }}"></script>
<script src="{{ asset('lottery-game/js/game.js') }}"></script>
<script src="{{ asset('lottery-game/js/mobile.js') }}"></script>
<script src="{{ asset('lottery-game/js/main.js') }}"></script>
<script src="{{ asset('lottery-game/js/loader.js') }}"></script>
<script src="{{ asset('lottery-game/js/init.js') }}"></script>
</body>

</html>