@inject('gameService', "Models\Gaming\GameService")

<div class="row">
    <div class="col-md-12 center">
        <button class="btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg btn-filter btn-filter-active" data-group="-1">ALL GAMES</button>

        @foreach ($gameService->getGroupsList() as $group => $name)
            <button class="btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg btn-filter" data-group="{{ $group }}" @if ($group == \Models\Gaming\Game::GROUP_SLOT) data-show-board="1" @endif>{{ mb_strtoupper($name) }}</button>
        @endforeach

        <button class="btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg btn-filter" data-group="popular"><i class="fas fa-star"></i> POPULAR</button>
    </div>
</div>


<div class="row jackpot-board" style="display: none">
    <div class="@if ($latestJackpot == null) col-md-12 @else col-md-4 @endif text-center">
        <h2 class="custom-underline alternative-font mb-xs">OCG JACKPOT</h2>
        <hr>
        <h4 class="custom-underline mb-xs money-earned"><i class="fas fa-coins"></i> {{ number_format($currentJackpot['size']) }}</h4>
        <h4 class="custom-underline mb-xs">{{ trans('app.since_date', ['date' => \Carbon\Carbon::now()->subDays($currentJackpot['days'])->format('d M Y')]) }}</h4>
        <h3 class="custom-underline alternative-font">BE THE LUCKY ONE!</h3>
    </div>
    @unless ($highestJackpot == null)
        <div class="col-md-4 text-center jackpot-board">
            <h2 class="custom-underline alternative-font mb-xs">HIGHEST WIN</h2>
            <hr>
            <h4 class="custom-underline mb-xs money-earned"><i class="fas fa-coins"></i> {{ number_format($highestJackpot->prize) }}</h4>
            <h4 class="custom-underline mb-xs">{{ trans_choice('app.days', $highestJackpot->days_since_jackpot, ['days' => $highestJackpot->days_since_jackpot]) }}</h4>
            {{--<h3 class="custom-underline alternative-font"><a href="{{ route('home.user.profile', ['username' => $highestJackpot->user->nickname]) }}"><i class="fas fa-user"></i> {{ $highestJackpot->user->nickname }}</a></h3>--}}
            @include('frontend.partials.username', ['user' => $highestJackpot->user])
        </div>
    @endunless

    @unless ($latestJackpot == null)
        <div class="col-md-4 text-center jackpot-board">
            <h2 class="custom-underline alternative-font mb-xs">LAST WIN</h2>
            <hr>
            <h4 class="custom-underline mb-xs money-earned"><i class="fas fa-coins"></i> {{ number_format($latestJackpot->prize) }}</h4>
            <h4 class="custom-underline mb-xs">{{ trans_choice('app.days', $latestJackpot->days_since_jackpot, ['days' => $latestJackpot->days_since_jackpot]) }}</h4>
            {{--<h3 class="custom-underline alternative-font"><i class="fas fa-user"></i> zack2057</h3>--}}
            @include('frontend.partials.username', ['user' => $latestJackpot->user])
        </div>
    @endunless
</div>

<div class="row">
    <ul class="sample-item-list sample-item-list-loaded">
        @foreach ($games as $game)
            <li data-group="{{ $game->group }}" class="col-sm-6 col-md-3 isotope-item game-item" @if ($game->isPopular()) data-popular @endif>
                <div class="sample-item sample-item-home pl-md pr-md">
                    <a href="{{ route('home.game', ['slug' => $game->slug]) }}" target="_blank">
                                    <span class="sample-item-image-wrapper">
                                        <span class="sample-item-image" data-original="{{ asset($game->icon_url) }}" data-plugin-lazyload data-plugin-options="{'appearEffect': 'animated fadeIn'}"></span>
                                        <i class="fa fa-spinner fa-spin fa-fw"></i>
                                    </span>
                        <span class="sample-item-description">
                                        <h5>{{ $game->name }}<br>
                                            {{--@if ($game->isInstantWin())--}}
                                            {{--<strong class="custom-underline alternative-font">Instant Win</strong>--}}
                                            {{--@else--}}
                                            {{--<strong class="custom-underline alternative-font">&nbsp;</strong>--}}
                                            {{--@endif--}}
                                        </h5>

                                    </span>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div>