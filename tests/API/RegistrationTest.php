<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    /**
     * Tests that a user can successfully register to the system given that it the inputs meet the requirements
     */
    public function testBasicRegistration()
    {
        $response = $this->json('POST', '/api/register', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => str_random(10) . '@test.com',
                'date_of_birth' => '1996-05-27',
                'password' => 'john123',
                'password_confirmation' => 'john123',
            ]);

        $response->assertStatus(200);
    }

    /**
     * Tests that the email unique validation check is being applied
     */
    public function testExistingEmail()
    {
        $response = $this->json('POST', '/api/register', [
            'first_name' => 'Deniz',
            'last_name' => 'Aygun',
            'email' => 'da332@kent.ac.uk',
            'date_of_birth' => '1996-05-27',
            'password' => 'deniz123',
            'password_confirmation' => 'deniz123',
        ]);

        $response->assertStatus(400);
    }
}
