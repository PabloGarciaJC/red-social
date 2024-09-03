<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// USUARIO
Route::get('/perfil', 'UserController@perfil')->name('perfil');
Route::post('/actualizar', 'UserController@actualizar')->name('actualizar');
Route::get('/fotoPerfil/{filename}', 'UserController@getImage')->name('foto.perfil');
Route::get('/usuario/{perfil}/', 'UserController@detallesPerfil')->name('detalles.perfil');
Route::get('/search', 'UserController@search')->name('search');

// FOLLOWERS
Route::post('/enviar', 'FollowersController@enviar')->name('enviar');
Route::post('/cancelar', 'FollowersController@cancelar')->name('cancelar');
Route::post('/confirmar', 'FollowersController@enviar')->name('confirmar');
Route::post('/denegar', 'FollowersController@cancelar')->name('denegar');


// Route::get('/aceptarContacto', 'FollowersController@aceptarContacto')->name('aceptarContacto');

// COMMENTS
Route::post('/comentarioSave', 'CommentController@save')->name('comentarioSave');
Route::get('/comentarioImagen/{filename}', 'CommentController@getImage')->name('comentarioImagen');

// PUBLICATION
Route::post('/publicationSave', 'PublicationController@save')->name('publicationSave');
Route::get('/publicationImagen/{filename}', 'PublicationController@getImage')->name('publicationImagen');
Route::get('/publicationDelete/{publicationId}', 'PublicationController@delete')->name('publicationDelete');
Route::get('/detalle/{publicationId}', 'PublicationController@detail')->name('publicationDetail');

// LIKE
// Route::get('/like/{publicationId}', 'LikeController@like')->name('likeSave');
// Route::get('/dislike/{publicationId}', 'LikeController@dislike')->name('likeSave');

Route::get('/like/{publicationId}', 'LikeController@like')->name('likeSave');
Route::get('/dislike/{publicationId}', 'LikeController@dislike')->name('dislikeSave');


// CHAT
Route::post('chat/message', 'ChatController@messageReceived')->name('chat.mesaage');

// NOTIFICACIONES
Route::get('markAsRead', function () {
  auth()->user()->unreadNotifications->markAsRead();
  return redirect()->back();
})->name('markAsRead');

Route::get('borrarNotificacion/{id}', function ($id) {
  $usuarioLogin = Auth::user()->find($id);
  $usuarioLogin->notifications()->delete();
  return redirect()->back();
})->name('borrarNotificacion');

