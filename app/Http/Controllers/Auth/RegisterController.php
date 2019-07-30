<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'surname' => $data['surname'],
            'date_of_birth' => \Carbon\Carbon::parse($data['date_of_birth'])->format('m/d/Y'),
            'phone_number' => $data['phone_number'],
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'trading_account_number' => mt_rand(1000000,9999999999),
            'balance' => mt_rand(1000,99999999),
            'open_trades' => mt_rand(1000,9999),
            'close_trades' => mt_rand(5000,9999),
            'role_id' => '3',
        ]);
    }

    protected function redirectTo( ) {
        if (Auth::check() && Auth::user()->role_id == '3') {
            return('/client');
        }
        elseif (Auth::check() && Auth::user()->role_id == '2') {
            return('/back-office');
        }
        else {
            return('/admin');
        }
    }
}


            