<?php

$this->router->add('home', '', 'HomeController@index');
$this->router->add('users', '/users', 'UsersController@index');
$this->router->add('users_show', '/users/{id:int}', 'UsersController@show');