@foreach ($scripts as $script)
    <script type="text/javascript" src="{{ asset("live-games/{$game->slug}/js/$script") }}"></script>
@endforeach