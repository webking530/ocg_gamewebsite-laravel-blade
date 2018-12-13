@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>General settings</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li>
                <a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li><a href="#">Settings</a></li>
            <li class="active">General</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <section style="background:#efefe9;">
                    <div class="board">
                        <div class="board-inner">
                            <ul class="nav nav-tabs" id="myTab">
                                <div class="liner"></div>
                                <li><a href="#profile" data-toggle="tab"
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

                                <li><a href="#mathserver" data-toggle="tab" title="Game Math Service">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-console"></i>
                                        </span>Game Math Service </a>
                                </li>

                                <li class="active"><a href="#other" data-toggle="tab" title="Other Options">
                                        <span class="round-tabs four">
                                            <i class="glyphicon glyphicon-unchecked"></i>
                                        </span>Other options
                                    </a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="profile">
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

                            <div class="tab-pane fade" id="mathserver">
                                <h3 class="head text-center">Game Math Service</h3>
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('admin.settings.regenerate_math') }}" class="btn btn-warning btn-lg confirm-click">Regenerate game math files</a>
                                    <a href="{{ route('admin.settings.restart_math_server') }}" class="btn btn-danger btn-lg confirm-click">Restart game math server</a>
                                </div>
                            </div>

                            <div class="tab-pane fade in active" id="other">

                                <div class="card card-accent-info">
                                    <div class="card-header">List</div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary addEditBtn" data-type="add" id="command-add" data-row-id="0">
                                                <span class="glyphicon glyphicon-plus"></span> Create
                                            </button>
                                        </div>
                                        <hr>

                                        <div class="col-md-12">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
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
            <form method="post" id="settingForm" action="{{route('setting.updateGeneral') }}">
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
                    <button type="submit" class="btn btn-primary"><span class="modalBtn"> Add </span> 
                        <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{!! mix('compiled/js/pages/generalsettings.js') !!}"></script>
@endsection