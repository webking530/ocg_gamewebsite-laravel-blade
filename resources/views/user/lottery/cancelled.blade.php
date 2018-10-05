@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/lottery.meta_cancelled.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/lottery.meta_cancelled.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/lottery.meta_cancelled.description') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/lottery.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/lottery.meta_cancelled.title') }}</strong></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content pending-container">
                            <div class="alert alert-info">{{ trans('frontend/lottery.cancelled_lotteries_explanation') }}</div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Lottery Stake</th>
                                            <th>Scheduled Date</th>
                                            <th>Ticket Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($lotteries as $lottery)
                                        <tr>
                                            <td class="text-left">
                                                <img width="60" class="img-responsive inline-block" src="{{ asset("img/lottery/{$lottery->stake_text}.png") }}" alt="{{ trans("frontend/lottery.{$lottery->stake_text}") }}">
                                                <h3 class="inline-block" style="margin:10px">{{ trans("frontend/lottery.{$lottery->stake_text}") }}</h3>
                                            </td>
                                            <td class="text-left">
                                                {{ $lottery->date_begin->format('l, F j, Y, g:i a') }}
                                            </td>
                                            <td class="text-left">
                                                <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($lottery->ticket_price) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {!! $lotteries->render() !!}
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