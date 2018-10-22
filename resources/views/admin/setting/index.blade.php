@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{!! asset('css/pages/dataTables.bootstrap.css') !!}">
@endsection
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
                                                <label class="btn btn-default btn-on <?php echo($settings['user_registration']['value'] == 'on' ? 'active' : '') ?>">
                                                    <input type="radio" id="on" value="on" class="registration"
                                                           name="registration"
                                                           checked="<?php echo($settings['user_registration']['value'] == 'on' ? 'checked' : '') ?>">ON</label>
                                                <label class="btn btn-default btn-off <?php echo($settings['user_registration']['value'] == 'off' ? 'active' : '') ?>">
                                                    <input type="radio" id="off" value="off" class="registration"
                                                           name="registration"
                                                           checked="<?php echo($settings['user_registration']['value'] == 'off' ? 'checked' : '') ?>">OFF</label>
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
                                                <label class="btn btn-default btn-on <?php echo($settings['user_registration']['value'] == 'on' ? 'active' : '') ?>">
                                                    <input type="radio" id="on" value="on" class="maintenance"
                                                           name="maintenance"
                                                           checked="<?php echo($settings['user_registration']['value'] == 'on' ? 'checked' : '') ?>">ON</label>
                                                <label class="btn btn-default btn-off <?php echo($settings['user_registration']['value'] == 'off' ? 'active' : '') ?>">
                                                    <input type="radio" id="off" value="off" class="maintenance"
                                                           name="maintenance"
                                                           checked="<?php echo($settings['user_registration']['value'] == 'off' ? 'checked' : '') ?>">OFF</label>
                                            </div>
                                        </form>
                                    </div>                                </div>
                                <div class="tab-pane fade" id="other">
                                    <h3 class="head text-center">Other Options</h3>
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

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('input[type=radio][name=registration]').change(function () {
                $.ajax({
                    url: 'registration/' + $(this).val(),
                    type: 'GET',
                    success: function (data) {
                        if (data == 1) {
                            if ($(this).val() == 'on') {
                                swal("Registration Enabled Successfully")
                            }else{
                                swal("Registration Disabled Successfully")
                            }
                        } else {
                            $('input[type="radio"]').not(':checked').prop("checked", true);
                        }
                    }
                });
            });
            $('input[type=radio][name=maintenance]').change(function () {
                $.ajax({
                    url: 'maintenancemode/' + $(this).val(),
                    type: 'GET',
                    success: function (data) {
                        if (data == 1) {
                            if ($(this).val() == 'on') {
                                swal("Maintenance Mode Enabled Successfully")
                            }else{
                                swal("Maintenance Mode Disabled Successfully")
                            }
                        } else {
                            $('input[type="radio"]').not(':checked').prop("checked", true);
                        }
                    }
                });
            });
        });
    </script>
@endsection