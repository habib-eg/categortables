<?php

namespace Habib\Categortable\Providers;

use Illuminate\Support\ServiceProvider;

class CategortableServiceProvider extends ServiceProvider
{
    public function getPath()
    {
        return dirname(__DIR__).'/';
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $package_path = $this->getPath();
        $this->mergeConfigFrom($package_path . 'config/category.php', 'category');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $package_path = $this->getPath();

        // publish config
        $this->publishes([
            $package_path . 'config/category.php' => config_path('category.php'),
        ], 'config');

        //publish migrations
        $this->publishes([
            $package_path . 'database/migrations/' => database_path('migrations')
        ], 'migrations');

        //publish factories
        $this->publishes([
            $package_path . 'database/factories/' => database_path('factories')
        ], 'factories');

        $this->loadMigrationsFrom($package_path . 'database/migrations');

        $this->loadFactoriesFrom($package_path . 'database/factories');

    }
}
