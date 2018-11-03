@extends('admin.layout.app')
@section('meta')
<title>{{ trans('user.edit.title') }} - {{ trans('user.edit.title') }}</title>
@endsection

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="featured-boxes mt-none mb-none">
                    <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                        <div class="box-content">
                            <h1 class="mb-lg text-blue text-center">
                                @if(isset($lottery))
                                Edit
                                @else
                                Add
                                @endif
                                Lottery

                            </h1>
                            <hr>
                            @if(isset($lottery))
                            {{ Form::model($lottery, array('route' => array('lottery.edit',$lottery->id), 'method' => 'post','class'=>'form-horizontal')) }}
                            @else
                            {{ Form::open(['route' => 'lottery.add','class'=>'form-horizontal']) }}
                            @endif

                            {{ csrf_field() }}
                            <!--                            <div class="form-group{{ $errors->has('prize') ? ' has-error' : '' }}">
                                                            <label for="name" class="col-md-4 control-label">Prize</label>
                            
                                                            <div class="col-md-6">
                                                                {{ Form::text('prize', Input::old('prize'),['id'=>'prize','class'=>'form-control','required'=>'required']) }}
                            
                                                                @if ($errors->has('prize'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('prize') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>-->

                            <div class="form-group{{ $errors->has('date_open') ? ' has-error' : '' }}">
                                <label for="date_open" class="col-md-4 control-label">Date Open</label>

                                <div class="col-md-6">
                                    {{ Form::text('date_open', Input::old('date_open'),['id'=>'date_open','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('date_begin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_open') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('date_close') ? ' has-error' : '' }}">
                                <label for="date_close" class="col-md-4 control-label">Date Close</label>
                                <div class="col-md-6">
                                    {{ Form::text('date_close', Input::old('date_close'),['id'=>'date_close','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('date_close'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_close') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('date_begin') ? ' has-error' : '' }}">
                                <label for="date_begin" class="col-md-4 control-label">Date Begin</label>

                                <div class="col-md-6">
                                    {{ Form::text('date_begin', Input::old('date_begin'),['id'=>'date_begin','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('date_begin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_begin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!--                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                            <label for="status" class="col-md-4 control-label">status</label>
                            
                                                            <div class="col-md-6">
                                                                {{ Form::text('status', Input::old('status'),['id'=>'status','class'=>'form-control','required'=>'required']) }}
                                                                @if ($errors->has('status'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>-->
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Type</label>

                                <div class="col-md-6">
                                    {{ Form::select('type',['Low','Mid','High'], Input::old('type'),['id'=>'type','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('ticket_price') ? ' has-error' : '' }}">
                                <label for="ticket_price" class="col-md-4 control-label">Ticket Price</label>

                                <div class="col-md-6">
                                    {{ Form::number('ticket_price', Input::old('ticket_price'),['id'=>'ticket_price','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('ticket_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ticket_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($lottery))
                                        Update
                                        @else
                                        Add
                                        @endif
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
