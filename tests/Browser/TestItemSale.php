<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TestItemSales extends DuskTestCase
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
                ->type('name', 'Book')
                ->type('description', 'An old book')
                ->select('category_id', '3')
                ->type('price', '5')
                ->press('Add item')
                ->assertSee('Seller Profile');
        });
    }
}