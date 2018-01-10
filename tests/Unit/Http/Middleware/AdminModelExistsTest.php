<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Matthewbdaly\LaravelAdmin\Http\Middleware\AdminModelExists;
use Mockery as m;

class AdminModelExistsTest extends TestCase
{
    /**
     * Test admin model can be reached when registered
     *
     * @return void
     */
    public function testCanReachAdminModelWhenRegistered()
    {
        // Set config
        $this->app['config']->set('admin.models', [
            'foo' => 'App\Foo'
        ]);
        
        // Create mock request
        $request = m::mock('Illuminate\Http\Request');
        $request->shouldReceive('route')->with('resource')->once()->andReturn('foo');

        // Create mock response
        $response = m::mock('Illuminate\Http\Response');
        $response->shouldReceive('getStatusCode')->andReturn(200);

        // Instantiate middleware
        $middleware = new AdminModelExists;

        // Call middleware
        $resp = $middleware->handle($request, function () use ($response) {
            return $response;
        });
        $this->assertEquals(200, $resp->getStatusCode());
    }

    /**
     * Test admin model cannot be reached when notregistered
     *
     * @return void
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testCannotReachAdminModelWhenNotRegistered()
    {
        // Create mock request
        $request = m::mock('Illuminate\Http\Request');
        $request->shouldReceive('route')->with('resource')->once()->andReturn('foo');

        // Create mock response
        $response = m::mock('Illuminate\Http\Response');

        // Instantiate middleware
        $middleware = new AdminModelExists;

        // Call middleware
        $resp = $middleware->handle($request, function () use ($response) {
            return $response;
        });
        $this->assertEquals(404, $resp->getStatusCode());
    }
}
