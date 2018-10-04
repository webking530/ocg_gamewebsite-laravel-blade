@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/lottery.meta_buy_tickets.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/lottery.meta_buy_tickets.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/lottery.meta_buy_tickets.description') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/lottery.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/lottery.meta_buy_tickets.title') }}</strong></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content pending-container">
                            <div class="row">
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

                                    <h2><strong class="countdown" data-route="{{ route('lottery.countdown.get') }}" data-lottery-id="{{ $lottery->id }}">{{ $lottery->getBeginCountdown()['text'] }}</strong></h2>
                                    <h5 class="alternative-font text-center about-to-start-text">{{ trans('frontend/lottery.countdown_start') }}</h5>
                                </div>

                            </div>

                            <hr>

                            <h2><strong>Choose one or multiple tickets to buy</strong></h2>



                            {!! Form::open() !!}

                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3 class="mb-sm"><i class="fas fa-ticket-alt"></i> Ticket Price</h3>
                                    <h2 class="money-earned"><i class="fas fa-coins"></i> {{ number_format($lottery->ticket_price) }}</h2>

                                    <button type="button" id="pickRandom" class="btn btn-primary btn-lg white-space-normal mb-sm"><i class="fas fa-question-circle"></i> Pick a random one for me</button>
                                    <a href="{{ route('user.lottery.buy_tickets', ['lottery' => $lottery]) }}" class="btn btn-warning btn-lg white-space-normal mb-sm"><i class="fas fa-eraser"></i> Clear All Selections</a>

                                    <button id="buyBtn" type="submit" class="btn btn-success btn-lg white-space-normal mb-sm" disabled><i class="fas fa-shopping-cart"></i> Buy Selected Tickets (<i class="fas fa-coins money-earned"></i> <span id="totalPrice">0</span>)</button>
                                </div>
                                <div class="col-md-6">
                                    <h3><i class="fas fa-clock-o"></i> Time left to confirm your reservation:</h3>
                                    <h2 id="clock-reservation">{{ \Models\Gaming\LotteryTicket::RESERVATION_TIME_MINUTES }}:00</h2>
                                </div>
                            </div>

                            <div class="row mt-xlg">
                                <div class="col-md-12 ticket-legend">
                                    <span class="label label-success">Selected Ticket</span>
                                    <span class="label label-danger">Reserved / Unavailable Ticket</span>
                                    <span class="label label-default">Available Ticket</span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 custom-scroll lottery-tickets-container" data-ticket-price="{{ $lottery->ticket_price }}" data-reserve-route="{{ route('user.lottery.reserve_ticket') }}" data-check-route="{{ route('user.lottery.check_ticket_reservation', ['lottery' => $lottery]) }}">
                                        @foreach ($lottery->unsoldTickets as $ticket)
                                            <div class="numbers available" data-ticket-id="{{ $ticket->id }}">
                                            @foreach ($ticket->numbers as $number)
                                                <span>{{ sprintf("%02d", $number) }}</span>
                                            @endforeach
                                                {!! Form::checkbox('numbers[]', $ticket->id, false, ['style' => 'display:none']) !!}
                                            </div>
                                        @endforeach
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! mix('compiled/js/pages/lottery.js') !!}"></script>
    <script src="{!! mix('compiled/js/pages/buy_tickets.js') !!}"></script>
@endsection