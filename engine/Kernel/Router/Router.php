<?php

namespace Engine\Kernel\Router;

class Router
{
    private array $routes = [];

    private UrlDispatcher $dispatcher;

    public function add(string $key, string $pattern, string $controller, string $method = 'GET'): void
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch($method, $uri): ?DispatchedRoute
    {
        return $this->getDispatcher()->dispatch($method, $uri);
    }

    public function getDispatcher(): UrlDispatcher
    {
        $this->dispatcher = new UrlDispatcher();

        foreach ($this->routes as $route) {
            $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
        }

        return $this->dispatcher;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}