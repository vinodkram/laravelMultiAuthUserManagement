@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Client / Back-Office Profile</div>
                <div class="panel-body">
                	@include('includes.messageDisplay')
					<form class="form-horizontal" method="POST" action="{{ route('admin.user.update') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$client->id}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ (old('name'))?old('name'):$client->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ (old('surname'))?old('surname'):$client->surname}}" required>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ (old('email'))?old('email'):$client->email}}" required autocomplete="off">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password (Leave blank for unchanged)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" autocomplete="new-password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="role_id" class="col-md-4 control-label">Assign Role</label>
                            <div class="col-md-6">
                                <select class="form-control m-bot15" autocomplete="off" name="role_id" id="role_id" required="required">
                                    <option value="" @if((old('role_id'))?old('role_id'):$client->role_id == '') selected @endif >-Select Role-</option>
                                    <option value="2" @if((old('role_id'))?old('role_id'):$client->role_id == '2') selected @endif >Back-Office</option>
                                    <option value="3" @if((old('role_id'))?old('role_id'):$client->role_id == '3') selected @endif >Client</option>
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <label for="date_of_birth" class="col-md-4 control-label">Date of Birth (mm/dd/yyyy)</label>

                            <div class="col-md-6">
                            	@if($client->date_of_birth!="")
                                <input id="date_of_birth" type="text" placeholder="mm/dd/yyyy" class="form-control" name="date_of_birth" value="{{ (old('date_of_birth'))?old('date_of_birth'):date('m/d/Y',strtotime($client->date_of_birth))}}">
                                @else
                                <input id="date_of_birth" type="text" placeholder="mm/dd/yyyy" class="form-control" name="date_of_birth" value="{{old('date_of_birth')}}">
                                @endif
                                @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ (old('phone_number'))?old('phone_number'):$client->phone_number}}">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ (old('address'))?old('address'):$client->address}}">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ (old('country'))?old('country'):$client->country}}">
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('trading_account_number') ? ' has-error' : '' }}">
                            <label for="trading_account_number" class="col-md-4 control-label">Trading Account Number</label>

                            <div class="col-md-6">
                                <input id="trading_account_number" type="text" class="form-control" name="trading_account_number" value="{{ (old('trading_account_number'))?old('trading_account_number'):$client->trading_account_number}}">
                                @if ($errors->has('trading_account_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('trading_account_number') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('balance') ? ' has-error' : '' }}">
                            <label for="balance" class="col-md-4 control-label">Balance</label>
                            <div class="col-md-6">
                                <input id="balance" type="text" class="form-control" name="balance" value="{{ (old('balance'))?old('balance'):$client->balance}}">
                                @if ($errors->has('balance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('balance') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('open_trades') ? ' has-error' : '' }}">
                            <label for="open_trades" class="col-md-4 control-label">Open Trade</label>

                            <div class="col-md-6">
                                <input id="open_trades" type="text" class="form-control" name="open_trades" value="{{ (old('open_trades'))?old('open_trades'):$client->open_trades}}">
                                @if ($errors->has('open_trades'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('open_trades') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('close_trades') ? ' has-error' : '' }}">
                            <label for="close_trades" class="col-md-4 control-label">Close Trade</label>

                            <div class="col-md-6">
                                <input id="close_trades" type="text" class="form-control" name="close_trades" value="{{ (old('close_trades'))?old('close_trades'):$client->close_trades}}">
                                @if ($errors->has('close_trades'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('close_trades') }}</strong>
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
