<?php

namespace Engine\Kernel\Router;

class DispatchedRoute
{
    public function __construct(private readonly string $controller, private readonly array $parameters = [])
    {
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}