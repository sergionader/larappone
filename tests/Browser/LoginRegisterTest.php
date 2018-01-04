<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class LoginRegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = 'user1@example.org';
        $password = 'test1234';
        $this->browse(function ($browser) use ($user, $password) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', $user)
                ->type('password', $password)
                ->click('@login-button')
                ->waitForText('John')
                ->assertSee('John');
        });
    }
}
