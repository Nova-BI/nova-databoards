<?php

namespace NovaBI\NovaDataboards;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use NovaBI\NovaDataboards\Http\Middleware\Authorize;

class NovaDataboardsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-databoards');


        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Config
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('nova-databoards.php'),
        ], 'config');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    /*
   protected function getMigrationFileName(Filesystem $filesystem): string
   {
       $timestamp = date('Y_m_d_His');

       return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
           ->flatMap(function ($path) use ($filesystem) {
               return $filesystem->glob($path . '*_create_permission_tables.php');
           })->push($this->app->databasePath() . "/migrations/{$timestamp}_create_permission_tables.php")
           ->first();
   }
   */


    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-databoards')
            ->group(__DIR__ . '/../routes/api.php');
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__ . '/../config/config.php'), 'nova-databoards');
    }
}
