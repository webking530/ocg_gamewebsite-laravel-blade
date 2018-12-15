@extends('admin.layout.app')
@section('title','Dashboard')
@section('css')
<!--<link rel="stylesheet" href="{!! mix('compiled/css/pages/admin_dashboard.css') !!}">-->
@endsection
@section('content')

<style>
    .mpg{
        border: 1px solid #000;
        padding: 5px;
        border-radius: 100%;
    }
</style>
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Dashboard</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li class="active">Dashboard</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12 text-right">
        <small style="float: right;"><span class="mpg">mpg</span> &nbsp;&nbsp; {{ $mostPlayedGame->getNameAttribute() }}</small>

    </div>

</div>
<hr>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="card card-accent-info">
            <div class="card-header">Payments &nbsp;</div>
            <div class="card-body table-responsive">

                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td class="text-primary">Withdrawals</td>
                            <td id="Withdrawals">${{ $paymentamount['withdrawn']->withdrawn or 0 }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Deposits</td>
                            <td id="Deposits">${{ $paymentamount['approved']->approved or 0 }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Pending Approval Deposits</td>
                            <td id="pendingDepositsApproval">${{ $paymentamount['pendingapprovalDeposit']->pendingapprovalDeposit or 0 }}</td>
                        </tr>
                        <tr>
                            <td class="text-primary">Pending Approval Withdrawals</td>
                            <td id="pendingwithdrawalsApproval" >${{ $paymentamount['pendingapprovalWithdrawal']->pendingapprovalWithdrawal or 0 }}</td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <div class="col-sm-6 col-md-8">
        <div class="card card-accent-info">
            <div class="card-header"> Last 10 payments to be approved </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="">
                    <th>Nickname</th>
                    <th>Email</th>
                    <th>Approved Date</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <!--<th>Payment Method</th>-->
                    </thead>
                    <tbody>
                        @if(!empty($paymentamount['lastTenApprovedPayments']))
                        @foreach($paymentamount['lastTenApprovedPayments'] as $payment)   
                        <tr>
                            <td> <img src="{{ asset($payment->user->flag_icon) }}" width="18" alt="{{ $payment->user->country_code }}"> {{ $payment->user->nickname }}</td>
                            <td>{{ $payment->user->email }}</td>
                            <td>{{ $payment->approved_at }}</td>
                            <td>${{ $payment->amount_USD }}</td>
                            <td>{{ $payment->currency_code }}</td>
                            <!--<td>{{ $payment->method }}</td>-->
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
    <div class="col-sm-6 col-md-6">
        <div class="card card-accent-info">
            <div class="card-header">Users Country </div>
            <div class="card-body table-responsive">


                <table class="table dataTable">
                    <thead class="">
                        <tr>
                            <th>Flag</th>
                            <th>Country</th>
                            <th>Users</th>
                            <th>Deposits</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!empty($usersByCountry))
                        @foreach($usersByCountry as $country)
                        <tr>
                            <td> <img width="20" src="{{ asset($country->getFlagIconAttribute()) }}"></td>
                            <td class="text-primary">{{ $country->getNameAttribute() }}</td>
                            <td>{{ $country->user->count() }}</td>
                            <td>{{ $country->getDepositsByCountry($country) }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="card card-accent-info">
            <div class="card-header">Users Gender </div>
            <div class="card-body table-responsive">

                <table class="table">
                    <thead class="">
                        <tr>

                            <th>Gender</th>
                            <th>Users</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-primary">Male Users</td>
                            <td>{{ $gender->male }}% </td>
                        </tr>
                        <tr>
                            <td class="text-primary">Female Users</td>
                            <td>{{ $gender->female }}%  </td>
                        </tr>

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card card-accent-info">
            <div class="card-header"> Top 10 players by : </div>
            <div class="card-body table-responsive">

                <ul class="nav nav-pills">
                    <li class="active">
                        <a class="nav-link active" data-id="credits" href="#credits" data-toggle="tab">
                            <i class="fa fa-credit-card"></i> Credits earned
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" data-id="deposited" href="#deposited" data-toggle="tab">
                            <i class="material-icons"></i> Money Deposited
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" data-id="withdrawn" href="#withdrawn" data-toggle="tab">
                            <i class="material-icons"></i> Money Withdrawn
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="credits">
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
                                    <td> <img src="{{ asset($earnedUser->user->flag_icon) }}" width="18" alt="{{ $earnedUser->country_code }}">  {{ $earnedUser->user->nickname }}</td>
                                    <td>{{ $earnedUser->user->email  }}</td>
                                    <td>{{ $earnedUser->win_amount }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="deposited">
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
                                    <td><img src="{{ asset($moneyDepositedUser->user->flag_icon) }}" width="18" alt="{{ $moneyDepositedUser->country_code }}">  {{ $moneyDepositedUser->user->nickname }}</td>
                                    <td>{{ $moneyDepositedUser->user->email  }}</td>
                                    <td>{{ $moneyDepositedUser->amount }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="withdrawn">
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
                                    <td> <img src="{{ asset($moneyWithdrawnUser->user->flag_icon) }}" width="18" alt="{{ $moneyWithdrawnUser->user->country_code }}"> {{ $moneyWithdrawnUser->user->nickname }}</td>
                                    <td>{{ $moneyWithdrawnUser->user->email  }}</td>
                                    <td>{{ $moneyWithdrawnUser->amount }}</td>
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

    <div class="col-sm-12 col-md-6">
        <div class="card card-accent-info">
            <div class="card-header"> Top 10 : </div>
            <div class="card-body table-responsive">

                <ul class="nav nav-pills">

                    <li class="active">
                        <a class="nav-link active" data-id="unverified" href="#unverified " data-toggle="tab">
                            <i class="material-icons"></i> Unverified Users 
                            <div class="ripple-container"></div>
                        </a>

                    </li>
                    <li>
                        <a class="nav-link" data-id="suspended" href="#suspended" data-toggle="tab">
                            <i class="material-icons"></i> Suspended Users 
                            <div class="ripple-container"></div>
                        </a>
                    </li>

                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade in active" id="unverified">
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
                                    <td> <img src="{{ asset($user->flag_icon) }}" width="18" alt="{{ $user->country_code }}"> {{ $user->nickname }}</td>
                                    <td>{{ $user->email  }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="suspended">
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
    <div class="col-sm-6 col-md-12">
        <div class="card card-accent-info">
            <div class="card-header">Most Played Game  :  {{ $mostPlayedGame->getNameAttribute() }}</div>
            <div class="card-body">
                <table  class="table table-hover dataTable">
                    <thead class="">
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
    <div class="col-sm-12 col-md-12">
        <div class="card card-accent-info">
            <div class="card-header"> Upcoming Lotteries :  </div>
            <div class="card-body table-responsive">

                <ul class="nav nav-pills">
                    @foreach($lotteries as $type => $lottery) 
                    <li class="{{ $type == 'low_stake' ? 'active' : '' }}">
                        <a class="nav-link" data-id="{{ $type }}" href="#{{ $type }}" data-toggle="tab">
                            <i class=""></i> {{ trans('frontend/lottery.'.$type) }}
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach($lotteries as $type => $lottery) 
                    <div class="tab-pane fade {{ $type == 'low_stake' ? 'active in' : '' }}" id="{{ $type }}">

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
                                <table class="table dataTable">
                                    <thead class="">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(!empty($lottery->participatedUserList()))
                                        @foreach($lottery->participatedUserList() as $participatedUser)
                                        <tr>
                                            <td> <img src="{{ asset($participatedUser->user->flag_icon) }}" width="18" alt="{{ $participatedUser->user->country_code }}"> {{ $participatedUser->user->nickname }}</td>
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
@endsection  
@section('js')
<script>
    $('.dataTable').dataTable({
        searching: false,
        "pageLength": 5,
    });

    $(function () {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end, label) {
            if (label == 'All Time') {
                $('#reportrange span').html(label);
            } else {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $.ajax({
                url: '{{ route("payment.filter") }}',
                data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'label': label, 'from': start.format('YYYY-M-D'), 'to': end.format('YYYY-M-D')},
                type: 'POST',
                success: function (data) {
                    var Withdrawals = data.withdrawn.withdrawn;
                    if (Withdrawals == null) {
                        Withdrawals = 0;
                    }
                    var Deposits = data.approved.approved;
                    if (Deposits == null) {
                        Deposits = 0;
                    }
                    var pendingapprovalDeposit = data.pendingapprovalDeposit.pendingapprovalDeposit;
                    if (pendingapprovalDeposit == null) {
                        pendingapprovalDeposit = 0;
                    }
                    var pendingapprovalWithdrawal = data.pendingapprovalWithdrawal.pendingapprovalWithdrawal;
                    if (pendingapprovalWithdrawal == null) {
                        pendingapprovalWithdrawal = 0;
                    }
                    $('#Deposits').text('$' + Deposits);
                    $('#Withdrawals').text('$' + Withdrawals);
                    $('#pendingDepositsApproval').text('$' + pendingapprovalDeposit);
                    $('#pendingwithdrawalsApproval').text('$' + pendingapprovalWithdrawal);
                }
            });


        }
        $('#reportrange').daterangepicker({
            startDate: null,
            endDate: null,
            autoApply: true,
            showCustomRangeLabel: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').add(1, 'day'), moment()],
                'All Time': [null, null]

            }
        }, cb);
        cb(start, end, 'All Time');
    });

</script>
<!--<script src="{!! mix('compiled/js/pages/admin_dashboard.js') !!}"></script>-->
@endsection