<section class="section">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center mb-xl">
                    <h2 class="mb-lg mt-md">Recent <strong>Winners</strong></h2>

                    <div class="owl-carousel owl-theme" data-plugin-options="{'items': 4, 'margin': 20, 'loop': true, 'autoplay': true, 'autoplayTimeout': 3000}">
                        @foreach ($bannersService->getRecentWinners() as $winner)
                            <div class="portfolio-item">
                                <a href="{{ route('home.game', ['slug' => $winner->game->slug]) }}">
                                    <span class="thumb-info thumb-info-lighten" >
                                        <span class="thumb-info-wrapper">
                                            <img src="{{ asset($winner->game->icon_url) }}" class="img-responsive" alt="{{ $winner->game->name }}">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner text-left">
                                                    <span class="game-name">{{ $winner->game->name }}</span><br>
                                                    <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($winner->net_win, 2) }}</span>
                                                </span>
                                                <span class="thumb-info-type {{ $winner->user->isMale() ? '' : 'label-pink' }}"><img class="little-flag-winners" src="{{ asset($winner->user->flag_icon) }}" width="18" alt=""> {{ $winner->user->nickname }}</span>
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