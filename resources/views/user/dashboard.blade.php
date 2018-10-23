@inject('carbon', "Models\Utility\CarbonService")
@extends('frontend.layout.app')

@section('meta')
    <title>My Dashboard - {{ trans('app.meta.short_title') }}</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/user_dashboard.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">My Dashboard</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-money-bill-alt"></i> Money</h4>
                                        <hr>
                                        @include('user.partials.balance')
                                        <hr>
                                        <div class="text-center mb-xlg">
                                            <a href="#" class="btn btn-success btn-xlg"><i class="fas fa-plus-circle"></i> Add Money</a>
                                            <a href="#" class="btn btn-warning btn-xlg"><i class="fas fa-minus-circle"></i> Withdraw Money</a>
                                        </div>

                                        @if ($user->isLowOnBalance())
                                            <div class="alert alert-warning text-center"><i class="fas fa-exclamation-circle"></i> LOW BALANCE</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-star"></i> Badges</h4>
                                        <hr>

                                        <div class="row dashboard-badges custom-scroll">
                                            @forelse ($user->badges as $badge)
                                                <div class="col-md-6 text-center single-badge">
                                                    <img width="64" class="img-responsive margin-auto" src="{{ asset($badge->image_url) }}" alt="{{ $badge->name }}">
                                                    <h4 class="text-uppercase">{{ $badge->name }}</h4>
                                                    <p class="text-light">{{ $badge->description }}</p>

                                                    @if ($badge->pivot->created_at->diffInDays(\Carbon\Carbon::now()) <= 1)
                                                        <p class="new-badge mb-none"><i class="fas fa-award"></i> NEW</p>
                                                    @else
                                                        <span class="new-placeholder"></span>
                                                    @endif
                                                </div>
                                            @empty
                                                <div class="alert alert-info text-center">You have not earned any badges yet!</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="featured-box featured-box-primary align-left mt-xs">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-gamepad"></i> Game Sessions<br>
                                        <small>Manage your open game sessions</small>
                                        </h4>
                                        <hr>

                                        @if ($user->gameSessions->count() > 0)
                                            <div class="alert alert-info">
                                                <ul>
                                                    <li>Credits for each open game session are part of your balance. Close the session to retrieve them.</li>
                                                    <li>You can also close a game session by clicking on the <i class="fas fa-times ml-md mr-md"></i> button while you are playing the game.</li>
                                                    <li><strong>Take advantage of multiple sessions. You can play several games in different browser tabs by distributing your balance between them.</strong></li>
                                                </ul>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th>Game</th>
                                                        <th>Credits</th>
                                                        <th>Opened at</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($user->gameSessions as $game)
                                                        <tr>
                                                            <td class="valign-middle"><img src="{{ asset($game->small_icon) }}" width="48"> {{ $game->name }}</td>
                                                            <td class="valign-middle"><span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($game->pivot->credits, 2) }}</span></td>
                                                            <td class="valign-middle">@datetime($game->pivot->created_at)</td>
                                                            <td class="valign-middle">
                                                                <a href="{{ route('user.game.manage_session', ['slug' => $game->slug]) }}" class="btn btn-success btn-sm"><i class="fas fa-play"></i> Play Live</a>
                                                                <a href="{{ route('home.game.demo', ['slug' => $game->slug]) }}" class="btn btn-warning btn-sm">Play Demo</a>
                                                                <a href="{{ route('user.session.close', ['game' => $game]) }}" class="btn btn-danger btn-sm confirm-click" data-confirm-content="{{ trans('frontend/game.this_will_refund') }}"><i class="fas fa-sign-out-alt"></i> Close Session</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th class="text-right">Total Credits</th>
                                                        <th><span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($user->gameSessionsCreditSum(), 2) }}</span></th>
                                                        <th></th>
                                                        <th>
                                                            <a href="{{ route('user.session.close_all') }}" class="btn btn-danger btn-sm confirm-click" data-confirm-content="{{ trans('frontend/game.this_will_refund_all') }}"><i class="fas fa-sign-out-alt"></i> Close All Sessions</a>
                                                        </th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @else
                                            <div class="alert alert-warning text-center">No active game sessions</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="featured-box featured-box-primary align-left mt-xs">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-users"></i> Discount Credit Program (DCP)</h4>
                                        <hr>

                                        @if ($user->dcp_suspended)
                                            <div class="alert alert-danger">{{ trans('frontend/payment.dcp_suspended_notification') }}</div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-link"></i> <abbr data-toggle="tooltip" data-original-title="Share your DCP link to invite other users and earn discount credits. Your invited users must use this link to register.">My DCP link:</abbr>
                                                        {{ route('home.register') }}?dcp={{ Auth::user()->nickname }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <a class="btn btn-primary btn" data-toggle="modal" data-target="#dcpRules">
                                                        <i class="fas fa-list"></i> Discount Credit Program (DCP) Rules
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($user->referrals->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Country</th>
                                                                    <th>Account Nickname</th>
                                                                    <th>Registered</th>
                                                                    <th>First Payment</th>
                                                                    <th>Discount Credit</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($user->referrals as $referral)
                                                                    <tr>
                                                                        <td>{{ $referral->country_name }}</td>
                                                                        <td>@include('frontend.partials.username', ['user' => $referral])</td>
                                                                        <td>@datetime($referral->created_at)</td>
                                                                        @if ($referral->first_approved_deposit != null)
                                                                            <td>
                                                                                @price($referral->first_approved_deposit->amount_USD, 'USD')
                                                                                <i data-toggle="tooltip" data-original-title="@price($referral->first_approved_deposit->amount, $referral->first_approved_deposit->currency)" class="fas fa-exchange-alt text-blue"></i>
                                                                                <i data-toggle="tooltip" data-original-title="{{ $carbon->timezone($referral->first_approved_deposit->created_at, $referral->timezone)->toDayDateTimeString() }}" class="fas fa-clock"></i>
                                                                            </td>
                                                                            <td>
                                                                                @if ($referral->first_approved_deposit->discountUsed())
                                                                                    <i data-toggle="tooltip" data-original-title="{{ trans('frontend/payment.discount_used') }}" class="fas fa-info-circle"></i>
                                                                                    <s class="text-success">
                                                                                @else
                                                                                    @if ( ! $referral->first_approved_deposit->canBeUsedForDiscount())
                                                                                        <i data-toggle="tooltip" data-original-title="{{ trans('frontend/payment.discount_refund_requested', ['date' => $carbon->timezone($referral->first_refund->created_at, $user->timezone)->toDayDateTimeString()]) }}" class="fas fa-info-circle"></i>
                                                                                        <s class="text-danger">
                                                                                    @endif
                                                                                @endif

                                                                                @price($referral->first_approved_deposit->calculated_discount_usd, 'USD')
                                                                                <i data-toggle="tooltip" data-original-title="@price($referral->first_approved_deposit->calculated_discount, $referral->first_approved_deposit->currency)" class="fas fa-exchange-alt text-blue"></i>

                                                                                @if ($referral->first_approved_deposit->discountUsed() || ! $referral->first_approved_deposit->canBeUsedForDiscount())
                                                                                    </s>
                                                                                @endif
                                                                            </td>
                                                                        @else
                                                                            <td>&mdash;</td>
                                                                            <td>&mdash;</td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @else
                                                        <div class="alert alert-warning text-center">No discounts available</div>
                                                    @endif

                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dcpRules" tabindex="-1" role="dialog" aria-labelledby="dcpRulesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="dcpRulesLabel">Discount Credit Program (DCP) Rules</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li class="mb-md">You will get discount credits valued at {{ \Models\Pricing\Deposit::DCP_DISCOUNT_PERCENT }}% from the invited user's first payment.</li>
                                <li class="mb-md">You can only get one time discount credits from each invited user.</li>
                                <li class="mb-md">You can invite unlimited users.</li>
                                <li class="mb-md">You cannot merge discount credits. You can only use one discount credit on each payment.</li>
                                <li class="mb-md">Discount credits can only be used for a payment which is at least 5 times bigger than the discount credit.</li>
                                <li class="mb-md">You would be subject to suspension from the Discount Credit Program (DCP) in the case of any abuse.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! mix('compiled/js/pages/user_dashboard.js') !!}"></script>
@endsection