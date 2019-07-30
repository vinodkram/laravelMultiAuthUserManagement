<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
    	DB::table('roles')->truncate();
        DB::table('roles')->insert(
        	[
            'id' => '1',
            'role_name' => 'Admin',
            'role_description' => 'Super Admin to manage entire website',
            'role_status' => '1',
        	]
        );
        DB::table('roles')->insert(
        	[
        	'id' => '2',
            'role_name' => 'BackOffice',
            'role_description' => 'Admin to manager clients',
            'role_status' => '1',
        	]
        );
        DB::table('roles')->insert(
        	[
        	'id' => '3',        		
            'role_name' => 'Client',
            'role_description' => 'Client registered on the site',
            'role_status' => '1',
        	]
        );
        Model::reguard();
    }
}
