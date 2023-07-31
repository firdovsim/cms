<?php

namespace Engine\Service\Router;

use Engine\Kernel\Router\Router;
use Engine\Service\ServiceProvider;

class RouterProvider extends ServiceProvider
{
    public string $serviceName = 'router';

    public function boot()
    {
        $router = new Router();

        $this->container->set($this->serviceName, $router);
    }
}