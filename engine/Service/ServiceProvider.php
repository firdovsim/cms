<?php

namespace Engine\Service;

use Engine\Container\ServiceContainer;

abstract class ServiceProvider
{
    public function __construct(protected readonly ServiceContainer $container)
    {
    }

    abstract public function boot();
}