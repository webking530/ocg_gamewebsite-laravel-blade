@extends('admin.layout.app')
@section('meta')
<title>{{ trans('user.edit.title') }} - {{ trans('user.edit.title') }}</title>
@endsection
@section('css')
<link href="{{ asset('compiled/plugins/datepicker/bootstrap-datetimepicker.min.css') }}"  rel="stylesheet">
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
                                @if(isset($news))
                                Edit
                                @else
                                Add
                                @endif
                                News

                            </h1>
                            <hr>
                            @if(isset($news))
                            {{ Form::model($news, array('route' => array('news.update',$news->id), 'method' => 'PUT','class'=>'form-horizontal','enctype'=>'multipart/form-data')) }}
                            @else
                            {{ Form::open(['route' => 'news.store','class'=>'form-horizontal']) }}
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
                            <div class="form-group{{ $errors->has('date_from') ? ' has-error' : '' }}">
                                <label for="date_from" class="col-md-4 control-label">Date From</label>

                                <div class="col-md-6">
                                    {{ Form::text('date_from',Input::old('date_from'),['id'=>'date_from','class'=>'form-control date','required'=>'required']) }}
                                    @if ($errors->has('date_from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_from') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('date_to') ? ' has-error' : '' }}">
                                <label for="date_to" class="col-md-4 control-label">Date To</label>

                                <div class="col-md-6">
                                    {{ Form::text('date_to', Input::old('date_to'),['id'=>'date_to','class'=>'form-control date','required'=>'required']) }}
                                    @if ($errors->has('date_to'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                <label for="order" class="col-md-4 control-label">order</label>

                                <div class="col-md-6">
                                    {{ Form::text('order', Input::old('order'),['id'=>'order','class'=>'form-control','required'=>'required']) }}
                                    @if ($errors->has('order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label">Content</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="3" placeholder="Content" name="content" id="content">
                                {{ (isset($news->content) && $news->content != null)?$news->content:  " " }}                                

                                    </textarea>
                                    <!--                                    {{ Form::text('content', Input::old('content'),['id'=>'content','class'=>'form-control','required'=>'required']) }}-->
                                    @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($news))
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

@section('js')

<script src="{{ asset('compiled/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('compiled/plugins/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

<script>
$(function () {
    CKEDITOR.replace('content');
    $('.date').datetimepicker({format: 'yyyy-mm-dd HH:m:i'});
});
</script>
@endsection
