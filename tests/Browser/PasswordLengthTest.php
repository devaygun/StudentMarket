<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PasswordLengthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPasswordLength()
    {
        $this->browse(function (Browser $browser) {
                $browser->visit('/register')
                    ->type('first_name', 'testing')
                    ->type('last_name', ('testing2'))
                    ->type('email', 'testing123456@kent.ac.uk')
                    ->keys('#date_of_birth', '1995-08-09')
                    ->type('password', 'test')              //Password is less than 6 characters long
                    ->type('password_confirmation', 'test') //Password is less than 6 characters long
                    ->clickLink('Register')
                    ->assertPathIs('/register');
            });
        }
}
