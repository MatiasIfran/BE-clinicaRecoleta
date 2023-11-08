<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserEndPointsTest extends TestCase
{
    public function testGetAllUsers()
    {
        $user = User::factory()->create(); 
        $headers = [
            'Accept'        =>  'application/json',
            'Content-Type'  => 'application/json',
        ];

        $response = $this->actingAs($user)
            ->withHeaders($headers)
            ->json('GET','/api/user/allUsers');
            
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'users',
        ]);
    }

   /* public function testGetUserById()
    {
        $user = User::factory()->create();
        $headers = [
            'Accept'        =>  'application/json',
            'Content-Type'  => 'application/json',
        ];

        $response = $this->actingAs($user)
            ->withHeaders($headers)
            ->json('GET','/user/' . $user->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'user',
        ]);
    }
    
    public function testGetNonExistentUser()
    {
        $nonExistentUserId = 999;

        $user = User::factory()->create();
        $headers = [
            'Accept'        =>  'application/json',
            'Content-Type'  => 'application/json',
        ];

        $response = $this->actingAs($user)
            ->withHeaders($headers)
            ->json('GET','/user/' . $nonExistentUserId);

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Usuario no encontrado']);
    }*/

}
