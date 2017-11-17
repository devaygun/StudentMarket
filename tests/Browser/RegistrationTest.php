<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;

class RegistrationTest extends DuskTestCase
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
            ->type('Richard', 'first_name')
            ->type('Bassey-Dight', 'last_name')
            ->type('rd339@kent.ac.uk', 'email')
            ->type('1995-08-09', 'date_of_birth')
            ->type('richard123', 'password')
            ->type('richard123', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home')
            ->visit('/home');
        });
    }
}
