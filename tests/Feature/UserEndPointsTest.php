<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserEndPointsTest extends TestCase
{
    use RefreshDatabase;

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

    /*public function testGetUserByIdWithValidUserId()
    {
        $user = User::factory()->create(); 
        $headers = [
            'Accept'        =>  'application/json',
            'Content-Type'  => 'application/json',
        ];

        $response = $this->actingAs($user)
            ->withHeaders($headers)
            ->get(route('user.getById', ['userId' => $user->id]));

        $response->assertStatus(200);
    }

    public function testGetUserByIdWithInvalidUserId()
    {
        // Autenticar al usuario
        $this->actingAs(User::factory()->create());

        $headers = [
            'Accept'        =>  'application/json',
            'Content-Type'  => 'application/json',
        ];

        $response = $this->withHeaders($headers)
                         ->get(route('user.getById', ['userId' => 12345])); // Un ID de usuario que no existe

        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Usuario no encontrado',
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
