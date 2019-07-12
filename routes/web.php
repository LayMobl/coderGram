<?php



//Routes d'authetification
Auth::routes();

//ROUTE DES FOLLOWS
//Ajout et suppression d'un follow
Route::post('follow/{user}', 'FollowController@store');


//ROUTE DES POSTS
//Liste des posts
Route::get('/', 'PostsController@index');
//Création d'un poste
Route::get('/p/create', 'PostsController@create');
//Détails d'un post
Route::get('/p/{post}', 'PostsController@show');
//Insert d'un post
Route::post('/p', 'PostsController@store');


//ROUTES DES PROFILS
//Détails d'un user
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
//Modification d'un user
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
//Update d'un user
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
