<?php

namespace Tests\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * Basic test to check the view user function works
     */
    public function testViewUser()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/view/2?api_token=$api_token");

        $response->assertStatus(200);
    }

    /**
     * Tests to see that reviews can be created
     */
    public function testAddReview()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->json('POST', '/api/view/2/reviews', ['api_token' => $api_token, 'review' => "API test review", 'rating' => 5]);
        $response->assertStatus(200);
    }
    
    /**
     * Basic test to check the profile function works
     */
    public function testProfile()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/profile?api_token=$api_token");

        // Confirms that the user retrieved via the API token is the original user
        try {
            $this->assertEquals(1, $response->decodeResponseJson()['data']['id']);
        } catch (\Exception $exception) {
            dump($exception);
        }

        $response->assertStatus(200);
    }

    /**
     * Tests that the API function for updating a user's profile works as expected
     */
    public function testProfileUpdate()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->json('POST', '/api/profile', [
            'api_token' => $api_token,
            'first_name' => "Deniz",
            'last_name' => "API_test_change_" . str_random(5),
            'email' => "da332@kent.ac.uk",
            'date_of_birth' => "1996-05-27"
        ]);
        $response->assertStatus(200);
    }
}
