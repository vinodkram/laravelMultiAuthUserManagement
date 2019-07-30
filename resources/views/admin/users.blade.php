@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users Listing
                    <a href="{{ route('backoffice.clients.add') }}" class="btn btn-primary a-btn-slide-text">
                        <span><strong>Add New Client / Back-Office</strong></span>            
                    </a>
                </div>

                <div class="panel-body">
					@include('includes.messageDisplay')
					<div class="table-responsive">
					  <table class="table">
					    <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Surname</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone No.</th>
                              <th scope="col">Date of Birth</th>
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->date_of_birth}}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-primary btn-xs">
                                    <span><strong>Edit</strong></span>  
                                </a>
                                <a href="{{ route('admin.user.delete', [$user->id]) }}" class="btn btn-primary btn-xs">
                                    <span><strong>Delete</strong></span>            
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
					  </table>
					</div>
				{{ $users->links() }}	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
