<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ValidRegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
            public function testBasicRegistration()
            {
                $this->browse(function ($browser) {
                    $browser->visit('/register')
                        ->type('first_name', 'TestGuy')
                        ->type('last_name', 'Jumbo')
                        ->type('email', 'testingemail@kent.ac.uk')
                        ->keys('#date_of_birth', '1995-08-09')
                        ->type('password', 'test123')
                        ->type('password_confirmation', 'test123')
                        ->clickLink('Register')
                        ->assertPathIs('/Login');
        });
    }
}
