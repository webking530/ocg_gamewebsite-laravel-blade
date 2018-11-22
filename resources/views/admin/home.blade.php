@extends('admin.layout.app')

@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/admin_dashboard.css') !!}">
@endsection
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-dollar">$</i>
                        </div>
                        <p class="card-category">Amount Pending For Approval</p>
                        <h3 class="card-title">${{ $paymentamount['pendingapproval']->pendingapproval or 0 }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">

                            <!--<a href="#pablo">Get More Space...</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-dollar">$</i>
                        </div>
                        <p class="card-category">Amount Approved</p>
                        <h3 class="card-title">${{ $paymentamount['approved']->approved or 0 }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <!--<i class="material-icons"></i> Last 24 Hours-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-dollar">$</i>
                        </div>
                        <p class="card-category">Amount Withdrawn</p>
                        <h3 class="card-title">${{ $paymentamount['withdrawn']->withdrawn or 0 }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <!--<i class="material-icons"></i> Tracked from Github-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-11 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Last 10 payments to be approved</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Approved Date</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Payment Method</th>
                            </thead>
                            <tbody>
                                @if(!empty($paymentamount['lastTenApprovedPayments']))
                                @foreach($paymentamount['lastTenApprovedPayments'] as $payment)   


                                <tr>
                                    <td>{{ $payment->user->nickname }}</td>
                                    <td>{{ $payment->user->email }}</td>
                                    <td>{{ $payment->approved_at }}</td>
                                    <td>${{ $payment->amount_USD }}</td>
                                    <td>{{ $payment->currency_code }}</td>
                                    <td>{{ $payment->method }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





        <div class="row">

            <div class="col-lg-11 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">

                        <h4 class="card-title">Most Played Game  :  {{ $mostPlayedGame->getNameAttribute() }}</h4>
                        <p class="card-category">Opened Sessions :  {{ $mostPlayedGame->sessions_opened }} </p>
                    </div>
                    <div class="card-body table-responsive" style="height:400px">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>Game</th>
                            <th>Deposited Money</th>
                            <th>Highest Win</th>
                            <th>Latest Win</th>
                            <th>Username</th>
                            </thead>
                            <tbody>
                                @foreach($games as $game)   


                                <tr>
                                    <td>{{ $game->getNameAttribute() }}</td>
                                    <td>{{ $game->getDepositedAmount($game) }}</td>
                                    <td>{{ $game->getHighestWinAmount($game) }}</td>
                                    <td>{{ $game->getLastWinAmount($game) }}</td>
                                    <td>{{$game->getWinningUser($game) }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <div class="ct-chart" id="dailySalesChart">Users by gender</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Male</h4>
                                <p class="card-category">
                                    <span class="text-success"><i class="fas fa-male"></i> {{ $gender->male }}% </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Female</h4>
                                <p class="card-category">
                                    <span class="text-success"><i class="fas fa-female"></i> {{ $gender->female }}% </span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-chart">
                    <div class="card-header card-header-warning">
                        <div class="ct-chart" id="websiteViewsChart">Users By Country</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($usersByCountry as $country)
                            <div class="col-md-3">
                                <h4 class="card-title">{{ $country->getCountryNameAttribute() }}</h4>
                                <p class="card-category">
                                    <span class="text-warning"><img width="20" src="{{ asset($country->getFlagIconAttribute()) }}"> {{ $country->users }} </span>
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-11 col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Top 10 players by : </span>
                                <ul class="nav nav-tabs topUsers" data-tabs="tabs" data-type="topUsers">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-id="credits" href="#credits" data-toggle="tab">
                                            <i class="fa fa-credit-card"></i> credits earned
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-id="deposited" href="#deposited" data-toggle="tab">
                                            <i class="material-icons"></i> Money Deposited
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-id="withdrawn" href="#withdrawn" data-toggle="tab">
                                            <i class="material-icons"></i> Money Withdrawn
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-id="unverified" href="#unverified " data-toggle="tab">
                                            <i class="material-icons"></i> Unverified Users 
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-id="suspended" href="#suspended" data-toggle="tab">
                                            <i class="material-icons"></i> Suspended Users 
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="max-height:500px;overflow-y: scroll;">
                        <div class="tab-content topUsers">
                            <div class="tab-pane active show" id="credits">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Credits Earned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($topUserByCreditsEarned))
                                        @foreach($topUserByCreditsEarned as $earnedUser)
                                        <tr>
                                            <td>{{ $earnedUser->user->nickname }}</td>
                                            <td>{{ $earnedUser->user->email  }}</td>
                                            <td>{{ $earnedUser->win_amount }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="deposited">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Money Deposited</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($topUserByMoneyDeposited))
                                        @foreach($topUserByMoneyDeposited as $moneyDepositedUser)
                                        <tr>
                                            <td>{{ $moneyDepositedUser->user->nickname }}</td>
                                            <td>{{ $moneyDepositedUser->user->email  }}</td>
                                            <td>{{ $moneyDepositedUser->amount }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="withdrawn">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Money Withdrawn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($topUserByMoneyWithdrawn))
                                        @foreach($topUserByMoneyWithdrawn as $moneyWithdrawnUser)
                                        <tr>
                                            <td>{{ $moneyWithdrawnUser->user->nickname }}</td>
                                            <td>{{ $moneyWithdrawnUser->user->email  }}</td>
                                            <td>{{ $moneyWithdrawnUser->amount }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="unverified">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Registered At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($unverifiedUsers))
                                        @foreach($unverifiedUsers as $user)
                                        <tr>
                                            <td>{{ $user->nickname }}</td>
                                            <td>{{ $user->email  }}</td>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="suspended">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Suspended At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($sudpendedUsers))
                                        @foreach($sudpendedUsers as $suspendeduser)
                                        <tr>
                                            <td>{{ $suspendeduser->nickname }}</td>
                                            <td>{{ $suspendeduser->email  }}</td>
                                            <td>{{ $suspendeduser->suspended_on }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-11 col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-danger">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Upcoming Lotteries : </span>
                                <ul class="nav nav-tabs lotteries" data-tabs="tabs" data-type="lotteries">
                                    @foreach($lotteries as $type => $lottery) 
                                    <li class="nav-item">
                                        <a class="nav-link {{ $type == 'low_stake' ? 'active' : '' }}" data-id="{{ $type }}" href="#{{ $type }}" data-toggle="tab">
                                            <i class=""></i> {{ trans('frontend/lottery.'.$type) }}
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="max-height:500px;overflow-y: scroll;">
                        <div class="tab-content lotteries">

                            @foreach($lotteries as $type => $lottery) 
                            <div class="tab-pane {{ $type == 'low_stake' ? 'active show' : '' }}" id="{{ $type }}">

                                @if(!empty($lottery))   
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <td>Lottery Begin At : </td>
                                                <td>{{ $lottery->date_begin  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lottery Open At : </td>
                                                <td>{{ $lottery->date_open  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Minimum Pot : </td>
                                                <td>{{ $lottery->prize  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tickets Sold : </td>
                                                <td>{{ $lottery->totalSoldTicket()  }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <td>Lottery Ticket price : </td>
                                                <td>{{ $lottery->ticket_price  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lottery Close At : </td>
                                                <td>{{ $lottery->date_close  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pot in lottery : </td>
                                                <td>{{ $lottery->getPotSize()  }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tickets Available : </td>
                                                <td>{{ $lottery->totalAvailablrTicket()  }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <h4>Participating Users</h4>    
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <table class="table">
                                            <thead class="text-danger">
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Email</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if(!empty($lottery->participatedUserList()))
                                                @foreach($lottery->participatedUserList() as $participatedUser)
                                                <tr>
                                                    <td>{{ $participatedUser->user->nickname }}</td>
                                                    <td>{{ $participatedUser->user->email  }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @else
                                {!! trans('frontend/lottery.no_scheduled_lottery') !!}  
                                @endif
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  
@section('js')
<script src="{!! mix('compiled/js/pages/admin_dashboard.js') !!}"></script>
@endsection