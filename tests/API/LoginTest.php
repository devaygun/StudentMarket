<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     *
     */
    public function testBasicLogin()
    {
        $response = $this->json('POST', '/api/login', ['email' => 'da332@kent.ac.uk', 'password' => 'deniz123']);

        echo json_encode($response);
        $response->assertStatus(200);
    }
}
