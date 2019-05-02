<?php

namespace Ingresse\Inspetor;

use Ingresse\Bootstrap\ServiceInterface;
use Ingresse\Persistence\Factory as RepositoryFactory;
use Phalcon\DiInterface;

class Services implements ServiceInterface
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param \Phalcon\DI\FactoryDefault $dependencyInjector
     *
     * @return void
     */
    public static function load(DiInterface $dependencyInjector)
    {
        $dependencyInjector->set('InspetorTracker', [
            'className' => 'Ingresse\Inspetor\Inspetor',
            'arguments' => [
                [
                    'type' => 'parameter',
                    'value' => $dependencyInjector
                        ->get('config')
                        ->inspetor
                        ->toArray()
                ]
            ]
        ]);
    }
}
