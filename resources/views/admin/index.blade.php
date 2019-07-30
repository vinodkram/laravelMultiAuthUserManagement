@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile
                		<a href="{{ route('admin.edit') }}" class="btn btn-info">Edit My Profile</a>
				</div>

                <div class="panel-body">
					@include('includes.messageDisplay')
					<div class="row" >
					    <div class="col-sm-6">
					        <p><span>Name </span>: {{$admin->name}} </p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Surname </span>: {{$admin->surname}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Email </span>: {{$admin->email}}</p>
					    </div>                                              
					    <div class="col-sm-6">
					        <p><span>Date of birth </span>:  {{$admin->date_of_birth}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Phone number </span>: {{$admin->phone_number}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Address </span>: {{$admin->address}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Country </span>: {{$admin->country}}</p>
					    </div>
					</div>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
