<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'petugas'], function () use ($router) {
    $router->post('login', 'PetugasController@loginPetugas');
    $router->post('register', 'PetugasController@createPetugas');
    
    //tambahkan middleware
    $router->get('{id}', ['midddleware' => 'auth', 'uses' => 'PetugasController@getPetugas']);
    $router->get('/', ['middleware' => 'auth', 'uses' => 'PetugasController@getAllPetugas']);
    $router->get('delete/{id}', ['middleware' => 'auth', 'uses' => 'PetugasController@deletePetugas']);
    $router->post('edit',['middleware' => 'auth', 'uses' => 'PetugasController@updatePetugas']);
    $router->post('edit/{id}', ['middleware' => 'auth', 'uses' => 'PetugasController@updatePetugasById']);
});
