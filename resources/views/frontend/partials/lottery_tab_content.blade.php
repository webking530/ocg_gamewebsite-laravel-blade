@if ($lottery == null)
    <div class="">
        <h2 style="font-size:30px" class="alternative-font text-center">
            <i style="font-size:70px" class="fas fa-clock mt-md mb-md"></i><br>
            {!! trans('frontend/lottery.no_scheduled_lottery') !!}
        </h2>
    </div>
@else
    @if ($lottery->isPending())
        <div class="">
            <h2 class="text-center"><strong class="countdown" data-route="{{ route('lottery.countdown.get') }}" data-lottery-id="{{ $lottery->id }}">{{ $lottery->getBeginCountdown() }}</strong></h2>
            <h3 class="alternative-font text-center">{{ trans('frontend/lottery.countdown_start') }}</h3>
            <hr>
            <div class="text-center mb-md">
                <h2 style="font-size:50px" class="alternative-font text-blue mb-lg mt-lg">{{ trans('frontend/lottery.prize') }}</h2>
                <h3 class="money-earned"><i class="fas fa-coins"></i> {{ number_format($lottery->getPotSize()) }}</h3>

                @if ($lottery->isSoldOut())
                    <h3 class="label label-danger" style="font-size:25px"><i class="fas fa-ticket-alt"></i> {{ trans('frontend/lottery.sold_out') }}</h3>
                @else
                    <a href="#" class="btn btn-success btn-lg"><i class="fas fa-ticket-alt"></i> {{ trans('frontend/lottery.buy_tickets_now') }}</a>
                @endif
            </div>
        </div>
    @elseif ($lottery->isActive())
        <div class="text-center">
            <h3 class="alternative-font text-center mt-lg" style="font-size:50px">{{ trans('frontend/lottery.lottery_in_progress') }}</h3>
            <a href="#" class="btn btn-success btn-lg"><i class="fas fa-eye"></i> {{ trans('frontend/lottery.watch_results') }}</a>
            <hr>
            <div class="text-center">
                <h2 style="font-size:50px" class="alternative-font text-blue mb-lg mt-lg">{{ trans('frontend/lottery.prize') }}</h2>
                <h3 class="money-earned"><i class="fas fa-coins"></i> {{ number_format($lottery->getPotSize()) }}</h3>
            </div>
        </div>

        <hr>

        <div class="text-center">
            <h2 style="font-size:50px" class="alternative-font text-center text-blue">
                <i class="fas fa-trophy"></i> {{ trans('frontend/lottery.winner') }}
            </h2>

            <a href="{{ route('home.user.profile', ['username' => $lottery->getWinnerUser()->nickname]) }}" class="btn btn-xlg btn-default {{ $lottery->getWinnerUser()->isMale() ? 'label-blue' : 'label-pink' }}"><img src="{{ asset($lottery->getWinnerUser()->flag_icon) }}" width="64" alt="{{ $lottery->getWinnerUser()->country_code }}"> <span style="font-size:20px;vertical-align: middle">{{ $lottery->getWinnerUser()->nickname }}</span></a>

            <div class="lottery-numbers">
                @foreach ($lottery->getWinningTicket()->numbers as $number)
                    <span>{{ $number }}</span>
                @endforeach
            </div>

            <h3 class="alternative-font text-light" style="font-size:30px">{{ trans('frontend/lottery.prize_won') }}:</h3>
            <h3 class="money-earned mt-xlg" style="font-size: 40px"><i class="fas fa-coins"></i> {{ number_format($lottery->getPotSize()) }}</h3>
            {{--<h2 class="alternative-font text-blue" style="font-size:60px">{{ trans('frontend/lottery.congratulations') }}<i class="fas fa-exclamation"></i></h2>--}}
        </div>
    @else
        <div class="">
            <h2 style="font-size:30px" class="alternative-font text-center">
                <i style="font-size:70px" class="fas fa-clock mt-md mb-md"></i><br>
                {!! trans('frontend/lottery.no_scheduled_lottery') !!}
            </h2>
        </div>
    @endif
@endif