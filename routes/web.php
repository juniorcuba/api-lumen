<?php

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/verify-token', 'AuthController@verifyToken');
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/users', 'UserController@index');
    $router->get('/user/{id}', 'UserController@show');
    $router->post('/users', 'UserController@store');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@destroy');
});


$router->get('/', function () use ($router) {
    return $router->app->version();
});

