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
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-gamepad"></i> Game Sessions</h4>
                                        <hr>

                                        @if ($user->gameSessions->count() > 0)
                                            <div class="alert alert-info">
                                                <p>Here you can manage your open game sessions.</p>
                                                <p>To retrieve your credits deposited to each game back to your balance, you can close its corresponding session from
                                                    here.</p>

                                                <p>You can do it while in-game too. After you finished playing the game, click on the "Quit" or "X" button.</p>

                                                <p><strong>Take advantage of multiple sessions, you can play multiple games in different tabs by distributing your balance between them!</strong></p>
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
                                                            <td class="valign-middle">@datetime($game->pivot->updated_at)</td>
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
                                            <div class="alert alert-info text-center">No active game sessions</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="featured-box featured-box-primary align-left mt-xs">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-users"></i> Discount Credit Program (DCP)</h4>
                                        <hr>

                                    </div>
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
    <script src="{!! mix('compiled/js/pages/user_dashboard.js') !!}"></script>
@endsection