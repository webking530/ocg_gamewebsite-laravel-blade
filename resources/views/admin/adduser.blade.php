@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">Add New User</div>
            <div class="panel-body">
                <form class="form-horizontal row-border add-user-form" method="post" action="{{ route('admin.saveUser') }}">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                {{ csrf_field() }}
                                <input type="text" name="name" class="form-control" id="name" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input class="form-control" type="text" name="lastname" id="lastname" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nick Name</label>

                                <input type="text" name="nickname" class="form-control" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Gender</label>

                                <select required class="form-control" name="gender">
                                    <option value="">Select</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>

                                <input type="number" name="mobile_number" class="form-control" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>

                                <input class="form-control" type="email" name="email" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Password</label>

                                <input type="password" name="password" class="form-control" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Avatar</label>

                                <input class="form-control" type="text" name="avatar_url" required>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Country</label>


                                <select class="form-control" name="country_code" required>
                                    <option value="">Select</option>
                                    @foreach($allCountry as $country)
                                        <option value="{{ $country['code'] }}">{{ $country['code'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Currency</label>


                                <select selected name="currency_code" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($allCurrency as $currency)
                                        <option value="{{ $currency['code'] }}">{{ $currency['code'] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Birthdate</label>

                                <input type="text" name="birthdate" class="form-control" id="birthday">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Role</label>
                                 <select required class="form-control" name="role">
                                    <option value="">Select</option>
                                    <option value="0">Admin</option>
                                    <option value="1">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Locale</label>

                                <select name="locale" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($alllocale as $locale)
                                        <option value="{{ $locale['code'] }}">{{ $locale['code'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Credits</label>

                                <input type="number" name="credits" class="form-control" required>

                            </div>
                        </div>

                    </div>



                    <button onclick="window.location.href='{{ route('admin.getUsers') }}'" type="button" class="btn btn-danger btn-lg pull-right" title="">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-lg pull-right" title="">Save</button>&nbsp;&nbsp;
                </form>
            </div>
        </div>
    </div>
</div>
@endsection