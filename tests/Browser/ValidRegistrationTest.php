<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ValidRegistrationTest extends DuskTestCase
{
    /**
     * Check that user registration is working correctly
     *
     * @return void
     */
    public function simpleItemSale()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('first_name', 'testing')
                ->type('last_name', ('testing2'))
                ->type('email', 'testing52364367@kent.ac.uk')
                ->keys('#date_of_birth', '19950809')
                ->type('password', 'testing')
                ->type('password_confirmation', 'testing')
                ->click('button[type="submit"]')
                ->assertPathIs('/home'); //Check that the user has been authenticated and is on the homepage
        });
    }
}
