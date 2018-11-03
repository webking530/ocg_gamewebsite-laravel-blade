@extends('admin.layout.app')
@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border:1px solid #d2d6de;">
            <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                <h3>Settings Management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                <section style="background:#efefe9;">
                    <div class="board">
                        <div class="board-inner">
                            <ul class="nav nav-tabs" id="myTab">
                                <div class="liner"></div>
                                <li class="active"><a href="#profile" data-toggle="tab"
                                                      title="Registration Enable/Disable">
                                        <span class="round-tabs two">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>Registration
                                    </a>
                                </li>
                                <li><a href="#maintenance" data-toggle="tab" title="Maintenance Mode">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-wrench"></i>
                                        </span>Maintenance Mode </a>
                                </li>

                                <li><a href="#other" data-toggle="tab" title="Other Options">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-unchecked"></i>
                                        </span>Other options
                                    </a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="profile">
                                <h3 class="head text-center">Enable/Disable User Registration</h3>
                                <div class="col-md-12">
                                    <form>
                                        <label>User Registration : </label>
                                        <div class="btn-group" id="status" data-toggle="buttons">
                                            <label class="btn btn-default btn-on {{ settings('registration_enable_disable') == 'on' ? 'active' : '' }}">
                                                <input type="radio" id="on" value="on" class="registration"
                                                       name="registration"
                                                       checked="{{ settings('registration_enable_disable') == 'on' ? 'checked' : '' }}">ON</label>
                                            <label class="btn btn-default btn-off {{ settings('registration_enable_disable') == 'off' ? 'active' : '' }}">
                                                <input type="radio" id="off" value="off" class="registration"
                                                       name="registration"
                                                       checked="{{ settings('registration_enable_disable') == 'on' ? 'checked' : '' }}">OFF</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="maintenance">
                                <h3 class="head text-center">Maintenance Mode</h3>
                                <div class="col-md-12">
                                    <form>
                                        <label>Maintenance Mode : </label>
                                        <div class="btn-group" id="status" data-toggle="buttons">
                                            <label class="btn btn-default btn-on {{ settings('maintenance_mode') == 'on' ? 'active' : '' }}">
                                                <input type="radio" id="on" value="on" class="maintenance"
                                                       name="maintenance"
                                                       checked="{{ settings('maintenance_mode') == 'on' ? 'checked' : '' }}">ON</label>
                                            <label class="btn btn-default btn-off {{ settings('maintenance_mode') == 'off' ? 'active' : '' }}">
                                                <input type="radio" id="off" value="off" class="maintenance"
                                                       name="maintenance"
                                                       checked="{{ settings('maintenance_mode') == 'off' ? 'checked' : '' }}">OFF</label>
                                        </div>
                                    </form>
                                </div>                                </div>
                            <div class="tab-pane fade" id="other">
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

                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
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