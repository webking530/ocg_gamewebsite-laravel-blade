<div class="col-md-6">
    <div class="col-md-6">
        <img width="180" class="img-responsive margin-auto" src="{{ asset("img/lottery/{$lottery->stake_text}.png") }}" alt="{{ trans("frontend/lottery.{$lottery->stake_text}") }}">
    </div>
    <div class="col-md-6">
        <h4 class="text-uppercase">{{ trans("frontend/lottery.{$lottery->stake_text}") }}</h4>

        <h2 style="font-size:50px" class="alternative-font text-blue mb-lg mt-lg">{{ trans('frontend/lottery.prize') }}</h2>
        @if ($lottery->canDisplayPrize())
            <h3 class="money-earned"><i class="fas fa-coins"></i> {{ number_format($lottery->getPotSize()) }}</h3>
        @else
            <h3 class="money-earned"><i class="fas fa-spin fa-spinner"></i> Calculating</h3>
        @endif
    </div>
</div>
<div class="col-md-6">
    <h3><i class="fas fa-calendar-alt"></i> Lottery scheduled for</h3>
    <h4 class="mb-md">{{ $lottery->date_begin->format('l, F j, Y, g:i a') }}</h4>

    @if ($lottery->isActive() || $lottery->isCompleted())
        <h3 class="alternative-font text-center mt-xlg" style="font-size:35px">{{ trans('frontend/lottery.lottery_in_progress') }}</h3>
    @elseif ($lottery->isCancelled())
        <h3 class="alternative-font text-center mt-xlg" style="font-size:35px">{{ trans('frontend/lottery.lottery_cancelled') }}</h3>
    @else
        <h2><strong class="countdown" data-route="{{ route('lottery.countdown.get') }}" data-lottery-id="{{ $lottery->id }}">{{ $lottery->getBeginCountdown()['text'] }}</strong></h2>
        <h5 class="alternative-font text-center about-to-start-text">{{ trans('frontend/lottery.countdown_start') }}</h5>
    @endif
</div>