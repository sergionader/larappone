<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;

class VisitAddEditTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testVisitAdd()
    {
        $user = 'user1@example.org';
        $password = 'test1234';
        $this->browse(function ($first, $second) use ($user, $password) {
            $first->loginAs(User::find(1))
            ->visit('http://127.0.0.1:8000/login')
            ->waitForText('Login')
            ->type('email', $user)
            ->type('password', $password)
            ->click('@login-button')
            ->waitForText('LarAppOne')
            ->visit('http://127.0.0.1:8000/app/create')
            ->waitForText('Unit')
            ->type('#dt', '11-15-2017')
            ->type('#tm', '12:30:00')
            ->select('profile_id', rand(1, 10))
            ->select('origin_id', rand(1, 9))
            ->select('products[]', rand(1, 30))
            ->type('#qtd', rand(1, 6))
            ->type('#amount', rand(15, 500))
            ->type('avg', 10)
            ->type('max', 20)
            ->type('min', 30)
            ->type('prec', 40)
            ->type('comment', 'lorem ipsum')
            ->click('#save-button')
            ->waitForText('Data saved!')
            ->visit('http://127.0.0.1:8000/app/edit/1')
            ->waitForText('Data Edit')
            ->select('profile_id', 1)
            ->select('origin_id', 1)
            ->click('#submit-update')
            ->waitForText('Data updated!')
            ->assertSee('Data updated!');
        });
    }
}
