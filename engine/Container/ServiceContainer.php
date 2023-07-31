<?php

namespace Engine\Container;

use InvalidArgumentException;

class ServiceContainer
{
    private array $container = [];

    public function set($key, $value): self
    {
        $this->container[$key] = $value;

        return $this;
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $this->container[$key];
        }
        throw new InvalidArgumentException("Service $key does not exist in Container");
    }

    public function has($key): bool
    {
        return isset($this->container[$key]);
    }
}