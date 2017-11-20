<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ValidLoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testValidLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','rd339@kent.ac.uk')
                ->type('password','richard123')
                ->clickLink('Login')
                ->waitUntil(10)
                ->assertSee('Password')
            ->assertPathIs('/login');
        });
    }
}
