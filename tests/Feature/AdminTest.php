<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends BrowserKitTestCase
{
    use RefreshDatabase;

    /**
     * Test home page
     *
     * @return void
     */
    public function testHomePage()
    {
        $user = factory(\Tests\Fixtures\User::class)->create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => bcrypt('password')
        ]);
        $this->be($user);
        $this->visit('/admin')
            ->seePageIs('/admin')
            ->assertResponseOk();
    }
}
