<?php

namespace LoteriaApi\Provider\Routes;

use Silex\Application;
use Silex\ControllerProviderInterface;

class IndexControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app) {
            $loteria = $app['request']->get('loteria');
            $concurso = $app['request']->get('concurso');

            try {
                $loteria = $app['factory']->getLoteria($loteria);

                $result = $loteria->findLastConcurso();

                if ($concurso) {
                    $result = $loteria->findByConcurso($concurso);
                }
                
                return $app->json($result, 200);
            } catch (\Exception $e) {
                return $app->abort(400);
            }
        });

        return $controllers;
    }
}
