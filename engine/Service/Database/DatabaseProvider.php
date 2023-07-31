<?php

namespace Engine\Service\Database;

use Engine\Service\ServiceProvider;
use Engine\Kernel\Database\Connection;

class DatabaseProvider extends ServiceProvider
{
    private string $serviceName = 'db';

    public function boot(): void
    {
        $this->container->set($this->serviceName, new Connection());
    }
}