<?php

//web
Route::get('/blog', 	'Web\PageController@blog')->name('blog');

Route::post('login', 			'AuthController@login');
Route::post('logout',			'AuthController@logout');
Route::post('register',			'AuthController@register');

Route::resource('profiles',	'ProfileController');
Route::resource('generals',	'GeneralController');
Route::resource('indirectos',	'IndirectoController');
Route::resource('indices',	'IndiceController');

Route::get('/post/{slug}', 		'Web\PageController@post')->name('post');
Route::get('/category/{slug}', 	'Web\PageController@category')->name('category');
Route::get('/tag/{slug}', 		'Web\PageController@tag')->name('tag');

Route::get('/general',     		'Web\PageController@general')->name('general');
Route::get('/equipo',      		'Web\PageController@equipo')->name('equipo');
Route::get('/material',      	'Web\PageController@material')->name('material');
Route::get('/obrero',      		'Web\PageController@obrero')->name('obrero');
Route::get('/transporte',      	'Web\PageController@transporte')->name('transporte');
Route::get('/indirecto',      		'Web\PageController@indirecto')->name('indirecto');
Route::get('/indice',      		'Web\PageController@indice')->name('indice');
Route::get('/oferta',      		'Web\PageController@oferta')->name('oferta');

//admin
Route::resource('users', 		'Admin\UserController');
Route::resource('roles', 		'Admin\RoleController');
Route::resource('permissions', 	'Admin\PermissionController');



Route::resource('grupo_equipos',	'Data\GrupoEquipoController');
Route::resource('equipos',			'Data\EquipoController');
Route::resource('grupo_materials', 	'Data\GrupoMaterialController');
Route::resource('materials',		'Data\MaterialController');
Route::resource('grupo_obreros',	'Data\GrupoObreroController');
Route::resource('obreros',			'Data\ObreroController');
Route::resource('transportes',		'Data\TransporteController');
Route::resource('zonas',			'ZonaController');

Route::resource('categories',		'Post\CategoryController');
Route::resource('posts',			'Post\PostController');
Route::resource('tags', 			'Post\TagController');
Route::resource('comments',			'Post\CommentController');

Route::resource('ofertas',			'Oferta\OfertaController');

Route::resource('grupo_precios',	'Precio\GrupoPrecioController');
Route::resource('precios',			'Precio\PrecioController');
Route::resource('proyectos',		'Proyecto\ProyectoController');

// Listas JSon
Route::get('listaprecios', 'Precio\PrecioController@search');
