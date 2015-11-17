<?php

namespace Intspirit\UndoSeeder;

use Intspirit\UndoSeeder\Console\Seeds\SeedUndoCommand;
use Illuminate\Support\ServiceProvider;

class UndoSeederServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSeedUndoCommand();
        $this->registerSeedRefreshCommand();

        $this->commands([
            'command.db.seed.undo',
            'command.db.seed.refresh'
        ]);
    }

    /**
     * Register the seed undo console command.
     *
     * @return void
     */
    protected function registerSeedUndoCommand()
    {
        $this->app->singleton('command.db.seed.undo', function ($app) {
            return new SeedUndoCommand($app['db']);
        });
    }

    /**
     * Register the seed refresh console command.
     *
     * @return void
     */
    protected function registerSeedRefreshCommand()
    {
        $this->app->singleton('command.db.seed.refresh', function ($app) {
            return new SeedRefreshCommand($app['db']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.db.seed.undo', 'command.db.seed.refresh'];
    }

}
