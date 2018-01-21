<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ValidLoginTest extends DuskTestCase
{
    /**
     * Check to see that valid user credentials authorises the user
     *
     * @return void
     */
    public function testValidLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','rd339@kent.ac.uk') //valid credentials
                ->type('password','richard123')    //valid credentials
                ->click('button[type="submit"]')
                ->waitUntil(5)
                ->assertSee('Item 1')  // Information seen on homepage
            ->assertPathIs('/home'); //Check user is taken to the correct page
        });
    }
}
