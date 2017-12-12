<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class updateEmailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','testUser@kent.ac.uk') //valid credentials
                ->type('password','test123')    //valid credentials
                ->waitForReload()
                ->visit('/profile')
                ->assertPathIs('/profile')
                ->assertSee('testUser@kent.ac.uk')
                ->type('email', 'testingUpdate@kent.ac.uk')
                ->clickLink('Update')
                ->assertSee('Successfully updated your profile.')
                ->visit('/login')
                ->visit('/profile')
                ->assertSee('testingUpdate@kent.ac.uk');
        });
    }
}
