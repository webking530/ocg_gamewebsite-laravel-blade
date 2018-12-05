@extends('admin.layout.app')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li class="active">Bonus Management</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <h2>Bonus Management</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Search Panel
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span></div>
            <div class="panel-body">
                <form role="form" name="search-form" id="search-form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="type">
                                    <option value="">Select type</option>
                                    <option value="0">Credits</option>
                                    <option value="1">Multiplier</option>
                                    <option value="2">Percent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="enabled">
                                    <option value="">Select Status</option>
                                    <option value="0">Enabled</option>
                                    <option value="1">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Bonus List
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
                <span class="pull-right">
                    <a href="{{ route('bonus.create') }}" class="btn  btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Create
                    </a>
                </span>
            </div>
            <div class="panel-body">
                <table id="Bonustbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Prize</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/bonus.js') !!}"></script>
@endsection
