<?php

namespace App\Http\Controllers;

class Controller extends AbstractController
{
    public function view($template, $vars)
    {
        if (! $this->container->has('view')) {
            throw new \LogicException('View service not found in service container');
        }

        return $this->container->get('view')->render($template, $vars);
    }
}