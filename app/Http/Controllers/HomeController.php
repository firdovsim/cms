<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('index', ['name' => 'Home']);
    }
}