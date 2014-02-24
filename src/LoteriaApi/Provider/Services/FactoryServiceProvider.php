<?php

namespace LoteriaApi\Provider\Services;

use LoteriaApi\Provider\Factory;
use Silex\Application;
use Silex\ServiceProviderInterface;

class FactoryServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['factory'] = $app->share(function ($app) {
            return new Factory($app['config.path'], $app['config.datasources']);
        });
    }

    public function boot(Application $app)
    {
    }
}
