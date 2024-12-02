<?php

namespace Modules\Iexternal\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iexternal\Listeners\RegisterIexternalSidebar;

class IexternalServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIexternalSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            // append translations
        });


    }

    public function boot()
    {
       
        $this->publishConfig('iexternal', 'config');
        $this->publishConfig('iexternal', 'crud-fields');

        $this->mergeConfigFrom($this->getModuleConfigFilePath('iexternal', 'settings'), "asgard.iexternal.settings");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iexternal', 'settings-fields'), "asgard.iexternal.settings-fields");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iexternal', 'permissions'), "asgard.iexternal.permissions");

        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iexternal\Repositories\ExternalRepository',
            function () {
                $repository = new \Modules\Iexternal\Repositories\Eloquent\EloquentExternalRepository(new \Modules\Iexternal\Entities\External());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iexternal\Repositories\Cache\CacheExternalDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iexternal\Repositories\ProviderRepository',
            function () {
                $repository = new \Modules\Iexternal\Repositories\Eloquent\EloquentProviderRepository(new \Modules\Iexternal\Entities\Provider());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iexternal\Repositories\Cache\CacheProviderDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iexternal\Repositories\SyncModelRepository',
            function () {
                $repository = new \Modules\Iexternal\Repositories\Eloquent\EloquentSyncModelRepository(new \Modules\Iexternal\Entities\SyncModel());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iexternal\Repositories\Cache\CacheSyncModelDecorator($repository);
            }
        );
// add bindings



    }


}
