<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class maxStringLastNameTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->resize(1920, 1080)
                ->type('first_name', 'testing')
                ->type('last_name', '5F94B6virbN10Qk3VFdsQt4gzghaPrBMSJxq8dsxDL5NDQMdH1Na66A0UM20ndI0JMwiNN7nj0ikxSrXBxAxWxvrxebCPhO7XNyQXxPiqWQhVgsKSFpVLn5F3ybDz8KVb4h6cXw4qErqillbpQ0VRi4f73kGO6AAcobwKEvkvDOr0Al43UY3fHbrwL2BVkFjoHBAiPK0GuEIdHFoNGOqygAVMwT3gSjHwQgIm1BNYEwt8l6A2SwhFFlWTWIETWgC') //256 Character string')
                ->type('email', 'testing12345644@kent.ac.uk')
                ->keys('#date_of_birth', '1995-08-09')
                ->type('password', 'test123')
                ->type('password_confirmation', 'test123')
                ->clickLink('Register')
                ->assertPathIs('/register')
                ->assertSee('The last name may not be greater than 255 characters.');
        });
    }
}
