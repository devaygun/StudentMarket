<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PasswordMisMatchTest extends DuskTestCase
{
    /**
     * Check that registration is not authorised when entering mis-matching passwords
     *
     * @return void
     */
            public function testPasswordMisMatch()
            {
                $this->browse(function ($browser) {
                    $browser->visit('/register')
                        ->type('first_name', 'TestGuys')
                        ->type('last_name', 'Jumbo')
                        ->type('email', str_random(5)+'@kent.ac.uk')
                        ->keys('#date_of_birth', '1995-08-09')
                        ->type('password', 'test123')             //Passwords do not match
                        ->type('password_confirmation', 'test13') //Passwords do not match
                        ->clickLink('Register')
                        ->assertPathIs('/register');
        });
    }
}
