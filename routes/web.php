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
    return $info = "Modul API : <strong> Kurikulum </strong>, Ver : <strong>0.1.0</strong>, " .  $router->app->version();
});

$router->get('akademik', "AkademikController@getTahunAkademik");

$router->post('ruangan', "RuanganController@add");
$router->put('ruangan', "RuanganController@upd");
$router->delete('ruangan', "RuanganController@del");
$router->get('ruangan', "RuanganController@get");

$router->post('matkul', "MasterMatakuliahController@add");
$router->put('matkul', "MasterMatakuliahController@upd");
$router->delete('matkul', "MasterMatakuliahController@del");
$router->get('matkul', "MasterMatakuliahController@get");

$router->post('jenjang', "JenjangController@add");
$router->put('jenjang', "JenjangController@upd");
$router->delete('jenjang', "JenjangController@del");
$router->get('jenjang', "JenjangController@get");

$router->post('prodi', "ProdiController@add");
$router->put('prodi', "ProdiController@upd");
$router->delete('prodi', "ProdiController@del");
$router->get('prodi', "ProdiController@get");