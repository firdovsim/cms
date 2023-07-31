<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function index(): void
    {
        echo 'Users::list';
    }

    public function show($id): void
    {
        echo 'Users::show';
    }
}