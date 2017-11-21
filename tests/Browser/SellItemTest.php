<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SellItemTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testItemSale()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('login')
                ->type('email','rd339@kent.ac.uk') //valid credentials
                ->type('password','richard123')    //valid credentials
                ->click('button[type="submit"]')
                ->clickLink('Sell Item')
                ->assertSee('price');
        });
    }
}
