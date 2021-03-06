@extends('admin.layout.app')
@section('title','Settings')
@section('content')

<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4> @if(isset($lottery)) Edit Lottery  @else Add Lottery @endif</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li>
                <a href="{{ route('setting.lottery') }}">
                    Lottery
                </a>
            </li>
            <li class="active"> @if(isset($lottery)) Edit Lottery  @else Add Lottery @endif</li>
        </ol>
    </div>
</div>
<hr>

<div class="row">
   
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                
                            @if(isset($lottery))
                            {{ Form::model($lottery, array('route' => array('lottery.update',$lottery->id), 'method' => 'post','class'=>'form-horizontal')) }}
                            @else
                            {{ Form::open(['route' => 'lottery.create','method' => 'post','class'=>'form-horizontal']) }}
                            @endif

                            
                            <div class="form-group{{ $errors->has('date_open') ? ' has-error' : '' }}">
                                <label for="date_open" class="col-md-4 control-label">Date Open</label>

                                <div class="col-md-6">
                                    {{ Form::text('date_open', Input::old('date_open'),['id'=>'date_open','class'=>'form-control date','required'=>'required']) }}
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
                                    {{ Form::text('date_close', Input::old('date_close'),['id'=>'date_close','class'=>'form-control date','required'=>'required']) }}
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
                                    {{ Form::text('date_begin', Input::old('date_begin'),['id'=>'date_begin','class'=>'form-control date','required'=>'required']) }}
                                    @if ($errors->has('date_begin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_begin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

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
                            @if(!isset($lottery))
                            <div class="form-group">
                                <label for="ticket_amount" class="col-md-4 control-label">Amount OfTicket</label>

                                <div class="col-md-6">
                                    {{ Form::number('ticket_amount','',['id'=>'ticket_amount','class'=>'form-control','requiticket_amountred'=>'required']) }}
                                </div>
                            </div>
                            @endif
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
@endsection
@section('js')
<script>
$(function () {
    $('.date').datetimepicker({format: 'yyyy-mm-dd HH:m:i'});
});
</script>
@endsection
