@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/lottery.meta_my_tickets.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/lottery.meta_my_tickets.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/lottery.meta_my_tickets.description') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/lottery.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/lottery.meta_my_tickets.title') }}</strong></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content pending-container">
                            <div class="row">
                                @include('user.lottery.partials.lottery_stake_price_section')
                            </div>
                            @if ($lottery->isPending())
                                <div class="row mt-md">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ route('user.lottery.buy_tickets', ['lottery' => $lottery]) }}" class="btn btn-success btn-lg"><i class="fas fa-ticket-alt"></i> {{ trans('frontend/lottery.buy_tickets_now') }}</a>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 custom-scroll lottery-tickets-container">
                                    @foreach ($myTickets as $ticket)
                                        <div class="numbers">
                                            @foreach ($ticket->numbers as $number)
                                                <span>{{ sprintf("%02d", $number) }}</span>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection