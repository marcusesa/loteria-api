<?php

namespace LoteriaApi\Provider\Services;

use LoteriaApi\Config;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['config'] = function ($app) {
            return (new Config)
                ->setApiPath($app['config.api_path'])
                ->setDirectory($app['config.directory'])
                ->setExt($app['config.ext']);
        };

        $app['config.datasources'] = function ($app) {
            return $app['config']
                ->setFileName('datasource');
        };

        $app['config.path'] = function ($app) {
            return $app['config']
                ->setFileName('path');
        };
    }

    public function boot(Application $app)
    {
    }
}
