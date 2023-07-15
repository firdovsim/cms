<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Engine\Kernel;
use Engine\Container\ServiceContainer;

try {
    $container = new ServiceContainer();
    $kernel = new Kernel($container);

    $kernel->bootstrap();
} catch (Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}