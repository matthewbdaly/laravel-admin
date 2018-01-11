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
}
