<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Matthewbdaly\LaravelAdmin\Http\Middleware\Admin;
use Mockery as m;
use Illuminate\Http\Request;

class AdminTest extends TestCase
{
    /**
     * Test users with admin access can navigate to the admin
     *
     * @return void
     */
    public function testAdminUserCanNavigateToAdmin()
    {
        // Mock user
        $user = m::mock('Tests\Fixtures\User');
        $user->shouldReceive('isAdmin')->once()->andReturn(true);

        // Mock the auth
        $auth = m::mock('Illuminate\Contracts\Auth\Guard');
        $auth->shouldReceive('user')->once()->andReturn($user);
        
        // Create request
        $request = Request::create('http://example.com/admin/', 'GET');

        // Create mock response
        $response = m::mock('Illuminate\Http\Response');
        $response->shouldReceive('getStatusCode')->andReturn(200);

        // Instantiate middleware
        $middleware = new Admin($auth);

        // Call middleware
        $resp = $middleware->handle($request, function () use ($response) {
            return $response;
        });
        $this->assertEquals(200, $resp->getStatusCode());
    }

    /**
     * Test users without admin access cannot navigate to the admin
     *
     * @return void
     */
    public function testNonAdminUserCannotNavigateToAdmin()
    {
        // Mock user
        $user = m::mock('Tests\Fixtures\User');
        $user->shouldReceive('isAdmin')->once()->andReturn(false);

        // Mock the auth
        $auth = m::mock('Illuminate\Contracts\Auth\Guard');
        $auth->shouldReceive('user')->once()->andReturn($user);
        
        // Create request
        $request = Request::create('http://example.com/admin/', 'GET');

        // Create mock response
        $response = m::mock('Illuminate\Http\Response');
        $response->shouldReceive('getStatusCode')->andReturn(200);

        // Instantiate middleware
        $middleware = new Admin($auth);

        // Call middleware
        $resp = $middleware->handle($request, function () use ($response) {
            return $response;
        });
        $this->assertEquals(302, $resp->getStatusCode());
    }

    /**
     * Test users who are not logged in cannot navigate to the admin
     *
     * @return void
     */
    public function testUnauthorisedUsersCannotNavigateToAdmin()
    {
        // Mock the auth
        $auth = m::mock('Illuminate\Contracts\Auth\Guard');
        $auth->shouldReceive('user')->once()->andReturn(null);
        
        // Create request
        $request = Request::create('http://example.com/admin/', 'GET');

        // Create mock response
        $response = m::mock('Illuminate\Http\Response');
        $response->shouldReceive('getStatusCode')->andReturn(200);

        // Instantiate middleware
        $middleware = new Admin($auth);

        // Call middleware
        $resp = $middleware->handle($request, function () use ($response) {
            return $response;
        });
        $this->assertEquals(302, $resp->getStatusCode());
    }

}
