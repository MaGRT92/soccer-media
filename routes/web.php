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

Route::get('/', 'PostController@index');

Route::get('/home', 'PostController@index')->name('home');

Auth::routes();

Route::group([
    'middleware' => 'roles',
    'namespace' => 'Admin',
    'roles' => ['Admin']
        ], function()
{
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    
    Route::get('/post', 'AdminPostController@index')->name('admin_post.index');
    Route::get('/post/create', 'AdminPostController@create')->name('admin_post.create');
    Route::get('/post/{post}', 'AdminPostController@show')->name('admin_post.show');
    Route::get('/post/{post}/edit', 'AdminPostController@edit')->name('admin_post.edit');
    Route::post('/post', 'AdminPostController@store')->name('admin_post.store');
    Route::patch('/post/{post}', 'AdminPostController@update')->name('admin_post.update');
    Route::delete('/post/{post}', 'AdminPostController@destroy')->name('admin_post.destroy');
}
);
