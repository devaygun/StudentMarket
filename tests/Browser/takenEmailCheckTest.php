<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class takenEmailCheckTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->resize(1920, 1080)
                ->type('first_name', 'testing')
                ->type('last_name', 'kGO6AAcobwKEv')
                ->type('email', 'rd339@kent.ac.uk') //email address has already been used into data seeds produced
                ->keys('#date_of_birth', '1995-08-09')
                ->type('password', 'test123')
                ->type('password_confirmation', 'test123')
                ->clickLink('Register')
                ->assertPathIs('/register')
                ->assertSee('The email has already been taken.');
        });
    }
}
