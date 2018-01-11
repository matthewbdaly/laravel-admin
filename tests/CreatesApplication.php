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

        Hash::setRounds(4);

        return $app;
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Tests\DummyKernel');
    }
}
