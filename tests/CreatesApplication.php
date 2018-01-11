<?php

namespace Tests;

use Hash;

trait CreatesApplication
{
	protected function getPackageProviders($app)
	{
		return ['Matthewbdaly\LaravelAdmin\Providers\ServiceProvider'];
	}

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = parent::createApplication();
        $app['config']->set('app.key', 'base64:LAgRRIqqEFcnz1FU5Or1IX3YVIRNnQk4lXsaxI26Hb4=');
        $app['config']->set('auth.providers.users.model', 'Tests\Fixtures\User');
        $app['config']->set('admin.models', []);

        Hash::setRounds(4);

        return $app;
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Tests\DummyKernel');
    }

    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'sqlite']);
        $this->loadLaravelMigrations(['--database' => 'sqlite']);
        $this->withFactories(__DIR__.'/factories');
    }
}
