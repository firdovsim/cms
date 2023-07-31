<?php

namespace Engine;

use Engine\Container\ServiceContainer;
use Engine\Helpers\Common;
use Engine\Kernel\Router\DispatchedRoute;
use Engine\Kernel\Router\Router;

class Kernel
{
    private Router $router;

    public function __construct(private readonly ServiceContainer $container)
    {
        $this->router = $this->container->get('router');
    }

    public function bootstrap(): void
    {
        require_once dirname(__DIR__) . '/app/routes.php';

        $current = $this->router->dispatch(Common::getHttpMethod(), Common::getPath());

        if ($current === null) {
            $current = new DispatchedRoute('ErrorController@notFound', []);
        }

        list($class, $action) = explode('@', $current->getController(), 2);

        $controller = sprintf("App\Http\Controllers\%s", $class);

        call_user_func_array([new $controller($this->container), $action], $current->getParameters());
    }
}