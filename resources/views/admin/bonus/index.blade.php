@extends('admin.layout.app')
@section('title','Bonuses')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Bonus Management</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Bonuses</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">Bonus List</div>
            <div class="card-body">
                <div class="text-center">
                    <button class="btn btn-warning filterBtn">Filter</button>
                     <a href="{{ route('bonus.create') }}" class="btn  btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Create
                    </a>
                </div>
                <hr>
                <div class="col-sm-8 col-sm-offset-2 well clearfix searchFilterDiv hidden">
                    <form role="form" name="search-form" id="search-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <select class="form-control select2" name="type">
                                        <option value="">Select type</option>
                                        @foreach(Lang::get('frontend/bonuses.type') as  $bonusKey => $bonus)
                                        <option value="{{ $bonusKey }}">{{ $bonus }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <select class="form-control select2" name="enabled">
                                        <option value="">Select Status</option>
                                        @foreach(Lang::get('frontend/bonuses.status') as  $statusKey => $status)
                                        <option value="{{ $statusKey }}">{{ $status }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-12">
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
</div>

@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/bonus.js') !!}"></script>
@endsection
