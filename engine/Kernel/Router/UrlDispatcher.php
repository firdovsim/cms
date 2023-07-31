<?php

namespace Engine\Kernel\Router;

class UrlDispatcher
{
    private array $availableMethods = [
        'GET',
        'POST'
    ];

    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    private array $patterns = [
        'int' => '[0-9]+',
        'str' => '[A-Za-z-_\.%]+',
        'any' => '[A-Za-z0-9-_\.%]+'
    ];

    public function addPattern(string $key, string $pattern): void
    {
        $this->patterns[$key] = $pattern;
    }

    public function getPatterns(): array
    {
        return $this->patterns;
    }

    public function getAvailableMethods(): array
    {
        return $this->availableMethods;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch($method, $uri): ?DispatchedRoute
    {
        $routes = $this->routes($method);

        if (array_key_exists($uri, $routes))
        {
            return new DispatchedRoute($routes[$uri]);
        }

        return $this->doDispatch($method, $uri);
    }

    public function register(string $method, string $pattern, string $controller): void
    {
        $convert = $this->convertPattern($pattern);

        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    private function convertPattern(string $pattern): array|string|null
    {
        if (!str_contains($pattern, '{')) {
            return $pattern;
        }

        return preg_replace_callback('#{(\w+):(\w+)}#', [$this, 'replacePattern'], $pattern);
    }

    private function replacePattern($matches): string
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }

    private function processParams($params)
    {
        foreach ($params as $k => $v) {
            if (is_int($k)) {
                unset($params[$k]);
            }
        }

        return $params;
    }

    private function doDispatch($method, $uri)
    {
        foreach ($this->routes($method) as $route => $controller) {
            $pattern = sprintf("#^%s$#s", $route);

            if (preg_match($pattern, $uri, $parameters))
            {
                return new DispatchedRoute($controller, $this->processParams($parameters));
            }
        }
    }

    private function routes(string $method): array
    {
        return $this->routes[strtoupper($method)] ?? [];
    }
}