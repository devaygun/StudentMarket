<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RemoveItemTest extends DuskTestCase
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
                ->type('email','rd339@kent.ac.uk') //valid credentials
                ->type('password','richard123')    //valid credentials
                ->visit('/items/books/5')
                ->assertSee('An old book')
                ->visit('/items/update/5')
                ->press('Remove item')
                ->assertDontSee('Book');
        });
    }
}
