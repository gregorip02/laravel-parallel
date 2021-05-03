<?php

namespace Stubleapp\Parallel;

use Illuminate\Support\ServiceProvider;

class LaravelParallelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/parallel.php', 'parallel');
    }

    /**
     * Determine if the app is running in console and isn't running test.
     */
    protected function runningInConsole(): bool
    {
        return $this->app->runningInConsole() && ! $this->app->runningUnitTests();
    }

    /**
     * Register the config for publishing.
     */
    public function boot(): void
    {
        if ($this->runningInConsole()) {
            $this->commands([
                RunParallelCommand::class,
            ]);
        }
    }
}
