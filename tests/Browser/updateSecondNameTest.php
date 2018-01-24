<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class updateSecondNameTest extends DuskTestCase
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
                ->assertInputValue('last_name', 'Test')
                ->type('last_name', 'newTestLastName')
                ->clickLink('Update')
                ->assertSee('Successfully updated your profile.')
                ->visit('/login')
                ->visit('/profile')
                ->assertInputValueIsNot('last_name','Test')
                ->assertInputValue('last_name', 'newTestLastName');
        });
    }
}
