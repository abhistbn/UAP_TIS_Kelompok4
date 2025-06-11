<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// Grup untuk route otentikasi (tanpa middleware auth)
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register'); 
    $router->post('/login', 'AuthController@login'); 
});

// Grup untuk route yang memerlukan autentikasi JWT
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    // Endpoint Mahasiswa
    $router->get('/mahasiswa', 'ApiController@getAllMahasiswa'); 
    $router->get('/mahasiswa/prodi/{id}', 'ApiController@getMahasiswaByProdi'); 

    // Endpoint Prodi
    $router->get('/prodi', 'ApiController@getAllProdi'); 

    // Endpoint Matakuliah
    $router->get('/matkul', 'ApiController@getAllMatakuliah'); 
    $router->post('/matkul/tambah', 'ApiController@tambahMatakuliah'); 
    $router->get('/matkul/{id}', 'ApiController@getMatakuliahMahasiswa'); 
});