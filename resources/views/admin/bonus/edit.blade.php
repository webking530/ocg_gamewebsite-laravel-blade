@extends('admin.layout.app')
@section('meta')
<title>{{ trans('user.edit.title') }} - {{ trans('user.edit.title') }}</title>
@endsection
@section('css')
{{--<link href="{{ asset('compiled/plugins/datepicker/bootstrap-datetimepicker.min.css') }}"  rel="stylesheet">--}}
@endsection
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="featured-boxes mt-none mb-none">
                    <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                        <div class="box-content">
                            <h1 class="mb-lg text-blue text-center">
                                @if(isset($bonus))
                                {{ trans('frontend/bonuses.edit_bonus') }}
                                @else
                                {{ trans('frontend/bonuses.add_bonus') }}
                                @endif
                            </h1>
                            <hr>
                            @if(isset($bonus))
                            {{ Form::model($bonus, array('route' => array('bonus.update',$bonus->id), 'method' => 'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data')) }}
                            @else
                            {{ Form::open(['route' => 'bonus.store','class'=>'form-horizontal']) }}
                            @endif

                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    {{ Form::text('name', Input::old('name'),['id'=>'name','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-4 control-label">Slug</label>

                                <div class="col-md-6">
                                    @if(isset($bonus))
                                    {{ Form::text('slug', Input::old('slug'),['disabled'=>'disabled','class'=>'form-control','required'=>'required']) }}
                                    @else
                                    {{ Form::text('slug', Input::old('slug'),['id'=>'slug','class'=>'form-control','required'=>'required']) }}
                                    @endif
                                    @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="order" class="col-md-4 control-label">Type</label>

                                <div class="col-md-6">
                                    {{ Form::select('type', ['Credits','Multiplier','Percent'],Input::old('type'),['id'=>'type','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('prize') ? ' has-error' : '' }}">
                                <label for="prize" class="col-md-4 control-label">Prize</label>

                                <div class="col-md-6">
                                    {{ Form::number('prize',Input::old('prize'),['id'=>'prize','class'=>'form-control date','required'=>'required']) }}
                                    @if ($errors->has('prize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prize') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('enabled') ? ' has-error' : '' }}">
                                <label for="order" class="col-md-4 control-label">Enabled</label>

                                <div class="col-md-6">
                                    {{ Form::select('enabled', ['No','Yes'],Input::old('enabled'),['id'=>'enabled','class'=>'form-control','required'=>'required']) }}

                                    @if ($errors->has('enabled'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enabled') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    {{ Form::textarea('description', Input::old('description'),['id'=>'description','class'=>'form-control date','required'=>'required']) }}
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($bonus))
                                        Update
                                        @else
                                        Add
                                        @endif
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                            <a href="../../../../../../../Users/admin/AppData/Local/Temp/.keypress() jQuery API Documentation httpsapi.jquery.comkeypress.URL"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('#type').change(function () {
            if ($(this).val() == 2)
                $("#prize").attr({
                    "max": 100,
                    "min": 1
                });
        });
        $("#name").keyup(function (event) {
            var name = $(this).val();
            var slug = name.replace(/ /g, "_");
            $('#slug').val(slug.toLowerCase());
        });
    });
</script>
@endsection
