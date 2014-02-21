<?php

use Silex\Application;
use LoteriaApi\Provider\Factory;
use LoteriaApi\Config;

$app = new Application();

$app['config.api_path'] = API_PATH;
$app['config.directory'] = 'etc';
$app['config.ext'] = 'ini';

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

$app['factory'] = $app->share(function ($app) {
    return new Factory($app['config.path'], $app['config.datasources']);
});

$app->get('/', function() use($app) {
    $loteria = $app['request']->get('loteria');
    $concurso = $app['request']->get('concurso');

    try {
        $loteria = $app['factory']
            ->getLoteria($loteria)
            ->findByConcurso($concurso);
        return $app->json($loteria, 200);
    } catch(\Exception $e) {
        return $app->abort(400);
    }
});

return $app;
