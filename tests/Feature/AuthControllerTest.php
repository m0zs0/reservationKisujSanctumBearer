<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use \App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_register(){
        // Arrange
        $payload = [
            'name'=> 'mozso1',
            'email'=> 'mozso1@moriczref.hu',
            'password' => 'Jelszo_2025',
            'password_confirmation' => 'Jelszo_2025',
        ];
        // Act
        $response = $this->postJson('/api/register', $payload);
        // Assert
        $response->assertStatus(201)->assertJsonStructure(['message','user']);
        $this->assertDatabaseHas('users',['email' => 'mozso1@moriczref.hu']);
    } 

    #[Test] 
    public function user_can_login_and_receive_token(){
        // Arrange
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => bcrypt('password'),
        ]);

        $credentials = [
            'email' => 'teszt@example.com',
            'password' => 'password',
        ];

        //Act
        $response = $this->postJson('/api/login', $credentials);
        //Assert
        $response->assertStatus(200)->assertJsonStructure(['access_token','token_type']);
    }
    


    #[Test] 
    public function user_can_logout(){


    }
}
