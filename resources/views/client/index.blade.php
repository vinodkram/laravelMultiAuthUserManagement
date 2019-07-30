@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile
                		<a href="{{ route('client.edit') }}" class="btn btn-info">Edit My Profile</a>
				</div>

                <div class="panel-body">
					@include('includes.messageDisplay')
					<div class="row" >
					    <div class="col-sm-6">
					        <p><span>Name </span>: {{$client->name}} </p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Surname </span>: {{$client->surname}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Email </span>: {{$client->email}}</p>
					    </div>                                              
					    <div class="col-sm-6">
					        <p><span>Date of birth </span>:  {{$client->date_of_birth}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Phone number </span>: {{$client->phone_number}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Address </span>: {{$client->address}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Country </span>: {{$client->country}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Trading Account Number </span>: {{$client->trading_account_number}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Balance </span>: {{$client->balance}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Open Trades </span>: {{$client->open_trades}}</p>
					    </div>
					    <div class="col-sm-6">
					        <p><span>Close Trades </span>:{{$client->close_trades}}</p>
					    </div>
					</div>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
