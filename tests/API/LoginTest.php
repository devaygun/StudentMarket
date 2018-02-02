<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    // use RefreshDatabase; (Resets the database after each test so that there isn't any interference)

    /**
     * Performs a simple login using existing credentials provided from a seed
     */
    public function testBasicLogin()
    {
        $response = $this->json('POST', '/api/login', ['email' => 'da332@kent.ac.uk', 'password' => 'deniz123']);
        
        $response->assertStatus(200);
    }

    /**
     * Tests that a valid existing API token works
     */
    public function testValidApiToken()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/items?api_token=$api_token");

        $response->assertStatus(200);
    }

    /**
     * Tests that an invalid API token doesn't work
     */
    public function testInvalidApiToken()
    {
        $response = $this->get("/api/items?api_token=INVALID_TOKEN_TEST");

        $response->assertStatus(400);
    }
}
