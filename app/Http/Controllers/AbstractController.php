<?php

namespace App\Http\Controllers;

use Engine\Container\ServiceContainer;

abstract class AbstractController
{
    public function __construct(public readonly ServiceContainer $container)
    {
    }
}