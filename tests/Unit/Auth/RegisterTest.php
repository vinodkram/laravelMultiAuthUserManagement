<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testUserRegisterAndLogin()
    {
        $user = factory(\App\User::class)->create([
            'name' => Str::random(6)." vin",
            'password' => bcrypt($password = 'password'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'role_id' => $user->role_id,
        ]);
        if($user->role_id == 1){
        	$response->assertRedirect('/admin');	
        }
        else if($user->role_id == 2){
        	$response->assertRedirect('/back-office');	
        }
        else if($user->role_id == 3){
        	$response->assertRedirect('/client');	
        }
        else {
        	$response->assertRedirect('/home');
        }
        
        $this->assertAuthenticatedAs($user);
    }
}
