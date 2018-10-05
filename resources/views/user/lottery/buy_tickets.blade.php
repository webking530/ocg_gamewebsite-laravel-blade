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

            <div class="row mt-lg mb-xlg">
                <div class="col-md-6 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/lottery.meta_buy_tickets.title') }}</strong></h2>
                </div>
                <div class="col-md-6 center">
                    <a href="{{ route('user.lottery.my_tickets', ['lottery' => $lottery]) }}" class="btn btn-xlg btn-quaternary white-space-normal"><i class="fas fa-ticket-alt"></i> {{ trans('frontend/lottery.buy_tickets.see_my_bought_tickets') }}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content pending-container">
                            <div class="row">
                                @include('user.lottery.partials.lottery_stake_price_section')
                            </div>

                            <hr>

                            @if ($lottery->isPending())
                                <h2><strong>Choose one or multiple tickets to buy</strong></h2>

                                {!! Form::open(['route' => ['user.lottery.buy_tickets.post', $lottery], 'class' => 'confirm-submit', 'data-confirm-content' => trans('frontend/lottery.buy_tickets.buy_confirm_content')]) !!}

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
                                                    {!! Form::checkbox('tickets[]', $ticket->id, false, ['style' => 'display:none']) !!}
                                                </div>
                                            @endforeach
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            @else
                                <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ trans('frontend/lottery.buy_tickets.reservations_closed') }}</div>
                            @endif
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