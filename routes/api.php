<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/post/create', 'PostController@store');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::get('/post/edit/{id}/html', 'PostController@editHtml');
Route::put('/post/update/{id}/{noticia}', 'PostController@update');
Route::delete('/post/delete/{id}', 'PostController@delete');
Route::get('/posts', 'PostController@index');
