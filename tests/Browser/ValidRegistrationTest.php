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
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('first_name', 'testing')
                ->type('last_name', ('testing2'))
                ->type('email', 'testing5236@kent.ac.uk')
                ->keys('#date_of_birth', '1995-08-09')
                ->type('password', 'testing')
                ->type('password_confirmation', 'testing')
                ->clickLink('Register');
                //->assertPathIs('/home'); //Check that the user has been authenticated and is on the homepage
        });
    }
}
