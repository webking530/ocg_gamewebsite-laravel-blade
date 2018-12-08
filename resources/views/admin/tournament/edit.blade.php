@extends('admin.layout.app')
@section('title','Tournaments')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>
            Edit Tournament for  {{ $tournament->formattedGroup }}
        </h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li>
                <a href="{{ route('tournament.index') }}">
                    Tournaments
                </a>
            </li>
            <li class="active">Edit Tournament</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                {{ Form::model($tournament, array('route' => array('tournament.update',$tournament->id), 'method' => 'PUT','class'=>'form-horizontal')) }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Games</label>

                    <div class="col-md-6">
                        <select name="game[]" multiple="true" class="form-control">
                            @foreach($games as $game)                    
                            <option  @if(in_array($game->id,$tournamentGames)) selected @endif value="{{ $game->id }}">{{ $game->getNameAttribute() }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                    <label for="level" class="col-md-4 control-label">Level</label>
                    <div class="col-md-6">
                        <select name="level"  class="form-control">
                            @for($i=0;$i<=\Models\Gaming\Tournament::MAX_LEVEL;$i++)
                            <option @if($tournament->level == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>



                <input type="hidden" name="group" value="{{ $tournament->group }}">

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@endsection
