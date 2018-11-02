@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-xs-12">


        <div class="box" style="">
            <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                <h3>General Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="well clearfix">
                <div class="pull-right">
                    <button type="button" class="btn btn-xs btn-primary addEditBtn" data-type="add" id="command-add" data-row-id="0">
                        <span class="glyphicon glyphicon-plus"></span> Create
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                <section style="background:#efefe9;">
                    <table id="settingsTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </section>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Create Key</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="form34"> <i class="fa fa-key prefix grey-text"></i> Key</label>
                        <input type="text" id="key" name="key" class="form-control validate">
                    </div>
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="form34"> <i class="fa fa-user prefix grey-text"></i> Value</label>
                        <input type="text" id="value" name="value" class="form-control validate">

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-unique"><span class="modalBtn"> Add </span> <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{!! mix('compiled/js/pages/generalSettings.js') !!}"></script>
@endsection