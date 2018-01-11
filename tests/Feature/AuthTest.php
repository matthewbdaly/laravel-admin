<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends BrowserKitTestCase
{
    use RefreshDatabase;

    /**
     * Test redirected if not logged in
     *
     * @return void
     */
    public function testRedirectedIfNotLoggedIn()
    {
        $this->visit('/admin/')
            ->seePageIs('/admin/login');
    }

    /**
     * Test login
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(\Tests\Fixtures\User::class)->create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => bcrypt('password')
        ]);
        $this->visit('/admin/login')
            ->type('bob@example.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('/admin');
    }

    /**
     * Test logout
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(\Tests\Fixtures\User::class)->create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => bcrypt('password')
        ]);
        $this->be($user);
        $this->visit('/admin/login')
            ->seePageIs('/admin');
        $this->call('POST', '/admin/logout');
        $this->visit('/admin/')
            ->seePageIs('/admin/login');
    }
}
