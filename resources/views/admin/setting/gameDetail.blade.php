@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/game_detail.css') !!}">
@endsection
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row user-menu-container square">
            <div class="col-md-12 user-details">
                <div class="row coralbg white">
                    <div class="col-md-6 no-pad">
                        <div class="user-pad">
                            <h3>{{ $game->getNameAttribute() }}</h3>
<!--                        <h4 class="white"><i class="fa fa-check-circle-o"></i> San Antonio, TX</h4>
                            <h4 class="white"><i class="fa fa-twitter"></i> CoolesOCool</h4>-->

                        </div>
                    </div>
                    <div class="col-md-6 no-pad">
                        <div class="user-image">
                            <img src="{{ asset($game->icon_url) }}" alt="{{ $game->name }}" class="img-responsive thumbnail">
                        </div>
                    </div>
                </div>
                <div class="row overview">
                    <div class="col-md-3 user-pad text-center">
                        <h3>winning player</h3>
                        <h4>{{ count($game->winnings) }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Total Money</h3>
                        <h4>{{ $game->credits }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Opened Session</h3>
                        <h4>{{ $game->sessions_opened }}</h4>
                    </div>
                    <div class="col-md-3 user-pad text-center">
                        <h3>Players currently in game</h3>
                        <h4>{{ count($gameActivePlayers->sessions) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>winning Player List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="playerTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
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
                                    <td>{{ $winner->pivot['win_amount'] }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        
          <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Currently in game player List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="playerTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nickname</th>
                                    <th>Email</th>
                                    <th>Credits</th>
                                    <th>Win Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($game->sessions))
                                @foreach($game->sessions as $session)
                                <tr>
                                    <td><a target="_blank" href="{{ route('user.index') }}/{{ $session->id }}">{{ $session->nickname }}</a></td>
                                    <td>{{ $session->email }}</td>
                                    <td>{{ $session->credits }}</td>
                                    <td>{{ $session->pivot['win_amount'] }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

</script>
@endsection
