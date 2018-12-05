@extends('admin.layout.app')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li>
            <a href="{{ route('tournament.index') }}">
                Tournament Management
            </a>
        </li>
        <li class="active">Create Custom Tournament</li>
    </ol>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Create Custom Tournament
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
            </div>
            <div class="panel-body">
                {{ Form::open(['route' => 'tournament.customStore','class'=>'form-horizontal']) }}
                {{ csrf_field() }}
                @foreach($languages as $language)                    
                <div class="form-group">
                    <label class="col-md-4 control-label">Group Name for {{$language->code}}</label>
                    <div class="col-md-6">

                        {{ Form::text('languages['.$language->code.']', '',['id'=>$language->code,'class'=>'form-control','required'=>'required']) }}
                    </div>
                </div>
                @endforeach
                <div class="form-group">
                    <label class="col-md-4 control-label">Games</label>
                    <div class="col-md-6">
                        <select name="game[]" class="form-control" multiple="multiple" data-plugin-multiselect>
                            @foreach($games as $game)                    
                            <option value="{{ $game->id }}">{{ $game->getNameAttribute() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                    <label for="level" class="col-md-4 control-label">Level</label>
                    <div class="col-md-6">
                        <select name="level"  class="form-control">
                            @for($i=0;$i<=5;$i++)                    
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

