<section class="section">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center mb-xl">
                    <h2 class="mb-lg mt-md">Recent <strong>Winners</strong></h2>

                    <div class="owl-carousel owl-theme" data-plugin-options="{'items': 4, 'margin': 20, 'loop': true, 'autoplay': true, 'autoplayTimeout': 3000}">
                        @foreach ($bannersService->getRecentWinners() as $game)
                            <div class="portfolio-item">
                                <a href="{{ route('home.game', ['slug' => $game->slug]) }}">
                                    <span class="thumb-info thumb-info-lighten" >
                                        <span class="thumb-info-wrapper">
                                            <img src="{{ asset($game->icon_url) }}" class="img-responsive" alt="{{ $game->name }}">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner text-left">
                                                    <span class="game-name">{{ $game->name }}</span><br>
                                                    <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format(array_random([1250,500,3650,120,7800,650,3000,550])) }}</span>
                                                </span>
                                                <span class="thumb-info-type {{ array_random(['', 'label-pink']) }}"><img class="little-flag-winners" src="{{ asset(array_random(['img/flags/de.png', 'img/flags/ve.png', 'img/flags/pt.png', 'img/flags/tr.png'])) }}" width="18" alt=""> {{ array_random(['username00323', 'username3349', 'username01', 'username007', 'username3122', 'username994', 'username011', 'username344']) }}</span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon"><i class="fas fa-play-circle"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>