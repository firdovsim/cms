<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Engine\Kernel;
use Engine\Container\ServiceContainer;

try {
    $container = new ServiceContainer();

    $services = require __DIR__ .'/Config/ServiceConfig.php';

    foreach ($services as $service) {
        $provider = new $service($container);
        $provider->boot();
    }

    $kernel = new Kernel($container);
    $kernel->bootstrap();
} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}