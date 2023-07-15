<?php

namespace Engine;

use Engine\Container\ServiceContainer;

class Kernel
{
    public function __construct(private readonly ServiceContainer $container)
    {
    }

    public function bootstrap()
    {
    }
}