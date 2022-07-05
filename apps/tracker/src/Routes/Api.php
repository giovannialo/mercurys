<?php

use LandKit\Route\Route;

/*
 * Api
 */
Route::controller('Source\Api');
Route::session('api/v1');

/*
 * Api: autenticação
 */
Route::post('/autenticar', 'AuthApi:signIn');

/*
 * Api: canal
 */
Route::session('api/v1/canais');
Route::get('/', 'ChannelApi:index');
Route::get('/{id}', 'ChannelApi:show');
Route::post('/', 'ChannelApi:create');
Route::put('/{id}', 'ChannelApi:update');
Route::delete('/{id}', 'ChannelApi:destroy');
