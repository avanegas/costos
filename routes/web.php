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

Route::redirect('/', 			'blog');

Auth::routes();

//web
Route::get('blog', 				'Web\PageController@blog')->name('blog');
Route::get('/post/{slug}',      'Web\PageController@post')->name('post');
Route::get('/category/{slug}',  'Web\PageController@category')->name('category');
Route::get('/tag/{slug}',       'Web\PageController@tag')->name('tag');

Route::get('equipo',      		'Web\PageController@equipo')->name('equipo');

// Post resource route.
Route::resource('categories', 	'Post\CategoryController');
Route::resource('posts',		'Post\PostController');
Route::resource('tags', 		'Post\TagController');
Route::resource('comments',		'Post\CommentController');

// Admin Users, Roles, Permission resource route.
Route::resource('users', 		'Admin\UserController');
Route::resource('roles', 		'Admin\RoleController');
Route::resource('permissions', 	'Admin\PermissionController');

Route::get('/home', 'HomeController@index')->name('home');

// Marcar como leido las notificaciones
Route::get('/markAsRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
});
