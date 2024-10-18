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

Auth::routes();

// USUARIO
Route::get('/perfil', 'UserController@perfil')->name('perfil');
Route::post('/actualizar', 'UserController@actualizar')->name('actualizar');
Route::get('/fotoPerfil/{filename}', 'UserController@getImage')->name('foto.perfil');
Route::get('/usuario/{perfil}/', 'UserController@detallesPerfil')->name('detalles.perfil');
Route::get('/search', 'UserController@search')->name('search');

// FOLLOWERS
Route::post('/followers/enviar', 'FollowersController@enviar')->name('enviar');
Route::post('/followers/cancelar', 'FollowersController@cancelar')->name('cancelar');
Route::post('/followers/confirmar/', 'FollowersController@confirmar')->name('confirmar');
Route::post('/followers/denegar', 'FollowersController@denegar')->name('denegar');

// COMMENTS
Route::post('/comentarioSave', 'CommentController@save')->name('comentarioSave');
Route::get('/comentarioImagen/{filename}', 'CommentController@getImage')->name('comentarioImagen');
Route::post('/editarComentario/{id}', 'CommentController@edit')->name('edit.comments');
Route::get('/borrarComentario/{id}', 'CommentController@delete')->name('delete.comments');

// PUBLICATION
Route::get('/', 'PublicationController@index')->name('home');
Route::post('/publicationSave', 'PublicationController@save')->name('publicationSave');
Route::post('/publicationEdit', 'PublicationController@edit')->name('publicationEdit');
Route::get('/publicationImagen/{filename}', 'PublicationController@getImage')->name('publicationImagen');
Route::get('/publicationDelete/{publicationId}', 'PublicationController@delete')->name('publicationDelete');

// LIKE
Route::get('/like/{publicationId}', 'LikeController@like')->name('likeSave');
Route::get('/dislike/{publicationId}', 'LikeController@dislike')->name('dislikeSave');

// CHAT
Route::post('/chats', 'ChatController@sendMessage')->name('chat.sendMessage');
Route::get('/chats/{userId1}/{userId2}', 'ChatController@getMessages')->name('chat.getMessages');
Route::get('/chats/send', 'ChatController@sendMessage')->name('chat.sendMessage');

// JUEGOS
Route::get('/game', 'GameController@show')->name('game.show');
Route::get('/game/guess', 'GameController@guess')->name('game.guess');


Route::get('/publicationImagen/{filename}', 'PublicationController@getImage')->name('publicationImagen');



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

