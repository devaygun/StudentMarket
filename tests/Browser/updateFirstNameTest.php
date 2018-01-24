<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class updateFirstNameTest extends DuskTestCase
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
                ->assertInputValue('first_name', 'TestUser')
                ->type('first_name', 'newTestFirstName')
                ->clickLink('Update')
                ->assertSee('Successfully updated your profile.')
                ->visit('/login')
                ->visit('/profile')
                ->assertInputValueIsNot('first_name','TestUser')
                ->assertInputValue('first_name', 'newTestFirstName');
        });
    }
}
