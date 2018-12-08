@extends('admin.layout.app')
@section('title','News')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>News Management</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">News</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">News List</div>
            <div class="card-body">
                <div class="text-center">
                    <a href="{{ route('news.create') }}" class="btn  btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Create
                    </a>
                </div>
                <hr>


                <div class="col-md-12">
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
</div>
@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/news.js') !!}"></script>
@endsection
