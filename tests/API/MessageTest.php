<?php

namespace Tests\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    /**
     * Basic test to retrieve a user's messages
     */
    public function testMessagesOverview()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/messages?api_token=$api_token");

        $response->assertStatus(200);
    }

    /**
     * Test to retrieve an individual message
     */
    public function testIndividualMessage()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/messages/2?api_token=$api_token");

        $response->assertStatus(200);
    }

    /**
     * Test sending of messages
     */
    public function testSendMessage()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->json('POST', '/api/messages/2', ['api_token' => $api_token, 'message' => 'A message from the API tests!']);

        $response->assertStatus(200);
    }
}
