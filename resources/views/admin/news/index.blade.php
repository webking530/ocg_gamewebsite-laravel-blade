@extends('admin.layout.app')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li class="active">News Management</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <h2>News Management</h2>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">News List
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
                <span class="pull-right">
                    <a href="{{ route('news.create') }}" class="btn  btn-default">
                                <span class="glyphicon glyphicon-plus"></span> Create
                    </a>
                </span>
            </div>
            <div class="panel-body">
                        <table id="Newstbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Date From</th>
                                    <th>Date to</th>
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
<script src="{!! mix('compiled/js/pages/news.js') !!}"></script>
@endsection
