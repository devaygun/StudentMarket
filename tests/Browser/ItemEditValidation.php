<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ItemEditValidation extends DuskTestCase
{
    /**
     * Tests to see that the user can successfully edit an item that they have made.
     *
     * @return void
     */
    public function testValidEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','rd339@kent.ac.uk') //valid credentials
                ->type('password','richard123')    //valid credentials
                ->visit('/items/books/5')
                ->press('Edit')
                ->assertSee('User is authorised to edit this item as they are the owner.');
        });
    }
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testValidView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','rd339@kent.ac.uk') //valid credentials
                ->type('password','richard123')    //valid credentials
                ->visit('/items/appliances/4')
                ->assertSee('Puppy')
                ->assertDontSee('Edit')
                ->assertDontSee('User is authorised to edit this item as they are the owner.');
        });
    }
}
