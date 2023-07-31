<?php

namespace Engine\Service\View;

use Engine\Kernel\Template\View;
use Engine\Service\ServiceProvider;

class ViewProvider extends ServiceProvider
{
    public string $serviceName = 'view';

    public function boot(): void
    {
        $this->container->set($this->serviceName, new View());
    }
}