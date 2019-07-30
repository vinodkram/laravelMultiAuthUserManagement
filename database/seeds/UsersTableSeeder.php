<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
    	DB::table('users')->truncate();

        DB::table('users')->insert(
        	[
            'name' => 'Super Admin',
            'email' => 'vinodkram@gmail.com',
            'password' => bcrypt('password'),
            'surname' => Str::random(6),
            'date_of_birth' => \Carbon\Carbon::parse('2000-01-01')->format('d/m/Y'),
            'phone_number' => mt_rand(1000000000,9999999999),
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'role_id' => '1',
        	]
        );	
        DB::table('users')->insert([
            'name' => 'Back Office',
            'email' => 'vinodkram+1@gmail.com',
            'password' => bcrypt('password'),
            'surname' => Str::random(6),
            'date_of_birth' => \Carbon\Carbon::parse('2000-01-01')->format('d/m/Y'),
            'phone_number' => mt_rand(1000000000,9999999999),
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'role_id' => '2',
        	]
        );	
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'surname' => Str::random(6),
            'date_of_birth' => \Carbon\Carbon::parse('2000-01-01')->format('d/m/Y'),
            'phone_number' => mt_rand(1000000000,9999999999),
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'trading_account_number' => mt_rand(1000000,9999999999),
            'balance' => mt_rand(1000,99999999),
            'open_trades' => mt_rand(1000,9999),
            'close_trades' => mt_rand(5000,9999),
            'role_id' => '3',
        	]
        );
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'surname' => Str::random(6),
            'date_of_birth' => \Carbon\Carbon::parse('2000-01-01')->format('d/m/Y'),
            'phone_number' => mt_rand(1000000000,9999999999),
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'trading_account_number' => mt_rand(1000000,9999999999),
            'balance' => mt_rand(1000,99999999),
            'open_trades' => mt_rand(1000,9999),
            'close_trades' => mt_rand(5000,9999),
            'role_id' => '3',
        	]
        );	
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'surname' => Str::random(6),
            'date_of_birth' => \Carbon\Carbon::parse('2000-01-01')->format('d/m/Y'),
            'phone_number' => mt_rand(1000000000,9999999999),
            'address' => Str::random(10).", ".Str::random(12).", ".Str::random(6),
            'country' => 'USA',
            'trading_account_number' => mt_rand(1000000,9999999999),
            'balance' => mt_rand(1000,99999999),
            'open_trades' => mt_rand(1000,9999),
            'close_trades' => mt_rand(5000,9999),
            'role_id' => '3',
        	]
        );
        Model::reguard();
    }
}
