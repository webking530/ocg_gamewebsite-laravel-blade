@extends('admin.layout.app')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Users</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Users Listing
				<span class="pull-right">
					<a href="{{route('admin.adduser')}}"  class="btn btn-lg btn-success">New User</a>
				</span>
			</div>
				<div class="panel-body">
					<div class="col-md-12">
						<table id="users-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            
            @if(count($getUsers)>0)
                @foreach($getUsers as $user)
                     <tr>
                        <td>{{ $user['name']}}</td>
                        <td>{{ $user['nickname']}}</td>
                        <td>{{ $user['email']}}</td>
                        <td>{{ $user['mobile_number']}}</td>
                        <td>{{ $user['gender']}}</td>
                       
                        <td>
                            <button class="btn btn-default btn-circle margin" type="button"><span class="fa fa-edit"></span></button>
                            <button class="btn btn-default btn-circle margin" type="button"><span class="fa fa-trash"></span></button>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection