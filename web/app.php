<?php

use Silex\Application;
use LoteriaApi\Provider\Services\FactoryServiceProvider;
use LoteriaApi\Provider\Routes\IndexControllerProvider;
use LoteriaApi\Provider\Services\ConfigServiceProvider;

$app = new Application();

$app->register(new ConfigServiceProvider(), [
    'config.api_path'      => API_PATH,
    'config.directory'     => 'etc',
    'config.ext'           => 'ini',
]);

$app->register(new FactoryServiceProvider, [
    'config.datasources' => $app['config.datasources'],
    'config.path'        => $app['config.path'],
]);

$app->mount('', new IndexControllerProvider());

return $app;
