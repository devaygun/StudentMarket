<?php

namespace Tests\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    /**
     * Basic test to check if retrieving all items works
     */
    public function testItemOverview()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/items?api_token=$api_token");

        $response->assertStatus(200);
    }

    /**
     * Basic test to check if retrieving an individual items works
     */
    public function testItemRead()
    {
        $api_token = User::find(1)->api_token;
        $response = $this->get("/api/items/appliances/1?api_token=$api_token");

        $response->assertStatus(200);
    }
}
