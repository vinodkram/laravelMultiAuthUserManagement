<?php

namespace Tests\Unit\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testUserCanViewLoginForm()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewLoginFormWhenAuthenticated()
    {
    	$user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

    public function testUserLoginWithCorrectCredentials()
    {
        $user = factory(\App\User::class)->create([
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

    public function testRememberMeFunctionality()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt($password = 'password'),
        ]);
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
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
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }
 
    /* 
    public function testUserReceivesEmailPasswordResetLink()
    {
        Notification::fake();
        $user = factory(User::class)->create();
        $response = $this->post('/password/email', [
            'email' => $user->email,
        ]);
        // assertions go here
    }
    */
}
