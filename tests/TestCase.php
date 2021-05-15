<?php

namespace Stubleapp\Parallel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Stubleapp\Parallel\LaravelParallelServiceProvider;

class TestCase extends Orchestra
{
    protected $loadEnvironmentVariables = true;

    /**
    * Get base path.
    *
    * @return string
    */
    protected function getBasePath()
    {
        return __DIR__ . '/laravel';
    }

    /**
    * Get package providers.
    *
    * @param  \Illuminate\Foundation\Application  $app
    *
    * @return array
    */
    protected function getPackageProviders($app)
    {
        return [
            LaravelParallelServiceProvider::class,
        ];
    }
}
