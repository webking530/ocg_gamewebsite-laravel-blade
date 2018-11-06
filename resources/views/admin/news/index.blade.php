@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                        <h3>News Management</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <div class="pull-right">
                            <a href="{{ route('news.create') }}" class="btn  btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Create
                            </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/news.js') !!}"></script>
@endsection
