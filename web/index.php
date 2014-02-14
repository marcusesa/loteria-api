<?php
require __DIR__.'/../bootstrap.php';

use Silex\Application;
use LoteriaApi\Provider\Factory;
use LoteriaApi\Config;

$app = new Application();

$app['config_api_path'] = API_PATH;
$app['config_directory'] = 'etc';
$app['config_ext'] = 'ini';

$app['config'] = function ($app) {
    return (new Config)
        ->setApiPath($app['config_api_path'])
        ->setDirectory($app['config_directory'])
        ->setExt($app['config_ext']);
};

$app['config_datasources'] = function ($app) {
    return $app['config']
        ->setFileName('datasource');
};

$app['config_path'] = function ($app) {
    return $app['config']
        ->setFileName('path');
};

$app['factory'] = $app->share(function ($app) {
    return new Factory($app['config_path'], $app['config_datasources']);
});

$app->get('/loteria/{loteria}/concurso/{concurso}', function($loteria, $concurso) use($app) {
    try {
        $loteria = $app['factory']
            ->getLoteria($loteria)
            ->findByConcurso($concurso);
        return $app->json($loteria, 200);
    } catch(\Exception $e) {
        return $app->abort(400);
    }
});

$app->run();
