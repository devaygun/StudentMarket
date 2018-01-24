<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InvalidBirthTest extends DuskTestCase
{
    /**
     * Test that an invalid D.O.B does not authenticate the user currently registering
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('first_name', 'testData')
                ->type('last_name', ('testData'))
                ->type('email', 'testing123456@kent.ac.uk')
                ->keys('#date_of_birth', '01-01-0001') //Invalid Date of Birth
                ->type('password', 'testing')
                ->type('password_confirmation', 'testing')
                ->clickLink('Register')
                ->assertPathIs('/register');
        });
    }
}
