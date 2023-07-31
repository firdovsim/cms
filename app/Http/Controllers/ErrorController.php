<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function notFound(): void
    {
        echo 'Page Not Found';
    }
}