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
                                @if(isset($country))
                                Edit
                                @else
                                Add
                                @endif
                                Country
                                
                            </h1>
                            <hr>
                            @if(isset($country))
                            {{ Form::model($country, array('route' => array('country.edit',$country->code), 'method' => 'post','class'=>'form-horizontal')) }}
                            @else
                            {{ Form::open(['route' => 'country.add','class'=>'form-horizontal']) }}
                            @endif

                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-4 control-label">Code</label>

                                <div class="col-md-6">
                                    {{ Form::text('code', Input::old('code'),['class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                                <label for="currency_code" class="col-md-4 control-label">Currency Code</label>

                                <div class="col-md-6">
                                    {{ Form::select('currency_code', $currency,Input::old('currency_code'),['id'=>'currency_code','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('currency_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pricing_currency') ? ' has-error' : '' }}">
                                <label for="pricing_currency" class="col-md-4 control-label">Pricing Currency</label>

                                <div class="col-md-6">
                                    {{ Form::select('pricing_currency',$currency, Input::old('pricing_currency'),['id'=>'pricing_currency','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('pricing_currency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pricing_currency') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('locale') ? ' has-error' : '' }}">
                                <label for="locale" class="col-md-4 control-label">Locale</label>

                                <div class="col-md-6">
                                    {{ Form::select('locale', $language,Input::old('locale'),['id'=>'locale','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('locale'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('locale') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('capital_timezone') ? ' has-error' : '' }}">
                                <label for="capital_timezone" class="col-md-4 control-label">Capital Timezone</label>

                                <div class="col-md-6">
                                    {{ Form::text('capital_timezone', Input::old('capital_timezone'),['id'=>'capital_timezone','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('capital_timezone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('capital_timezone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($country))
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