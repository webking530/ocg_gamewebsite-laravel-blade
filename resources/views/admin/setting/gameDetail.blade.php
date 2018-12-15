@extends('admin.layout.app')
@section('title','Settings')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/game_detail.css') !!}">
@endsection
@section('content')

<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4> Detail of {{ $game->getNameAttribute() }}</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li>
                <a href="{{ route('setting.games') }}">
                    Games
                </a>
            </li>
            <li class="active">Game Detail</li>
        </ol>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-xs-12">
        <div class="card card-accent-info">
            <div class="card-header">Info</div>
            <div class="card-body">

                <div class="col-md-6">
                    <h3 class="text-center">Game Name <hr> {{ $game->getNameAttribute() }}</h3>
                    <div class="row mt-lg">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive margin-auto" src="{{ asset($game->icon_url) }}" alt="{{ $game->name }}" />
                </div>

                <div class="row overview">
                    <div class="col-md-3 user-pad text-center">
                        <h3>Total Wins</h3>
                        <h4>{{ count($game->winnings) }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Game Money</h3>
                        <h4>{{ $game->credits }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Opened Sessions</h3>
                        <h4>{{ $game->sessions_opened }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Players currently in game</h3>
                        <h4>{{ count($gameActivePlayers->sessions) }}</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="card card-accent-info">
            <div class="card-header">winning Player List</div>
            <div class="card-body">
                <div class="col-md-12">
                    <table id="playerTbl1" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Credits</th>
                            <th>Win Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($game->winnings))
                        @foreach($game->winnings as $winner)
                        <tr>
                            <td><a target="_blank" href="{{ route('user.index') }}/{{ $winner->id }}">{{ $winner->nickname }}</a></td>
                            <td>{{ $winner->email }}</td>
                            <td>{{ $winner->credits }}</td>
                            <td>{{ $winner->pivot->win_amount }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="card card-accent-info">
            <div class="card-header">Currently in game player List</div>
            <div class="card-body">
                <div class="col-md-12">
                <table id="playerTbl2" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Credits</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(!empty($game->sessions))
                        @foreach($game->sessions as $session)
                        <tr>
                            <td><a target="_blank" href="{{ route('user.index') }}/{{ $session->id }}">{{ $session->nickname }}</a></td>
                            <td>{{ $session->email }}</td>
                            <td>{{ $session->credits }}</td>
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

@endsection

@section('js')
<script>
    $('#playerTbl1').dataTable();
    $('#playerTbl2').dataTable();
</script>
@endsection
