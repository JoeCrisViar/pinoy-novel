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

// User Route

Route::group(['namespace' => 'User'], function(){
    
    Route::get('/', array('as'=>'ajax.pagination','uses'=>'HomeController@index'));
    // ? means that {post?} or slug is not required
    Route::get('post/{post}', 'PostController@post')->name('post');


    Route::get('post/tag/{tag}', 'HomeController@tag')->name('tag');

    Route::get('post/category/{category}', 'HomeController@category')->name('category');

    
});


// Admin Route

Route::group(['namespace' => 'Admin'], function(){

    //Home Routes

    Route::get('admin/home', 'HomeController@index')->name('admin.home');

    // User Routes

    Route::resource('admin/user', 'UserController');
    
    // Post Routes

    Route::resource('admin/post', 'PostController');

    Route::get('admin/published', 'PostController@published')->name('admin.published');

    Route::get('admin/forpublishing', 'PostController@publishing')->name('admin.publishing');

    Route::get('admin/forediting', 'PostController@editing')->name('admin.editing');

    // Title Routes

    Route::resource('admin/title', 'TitleController');

    // Tag Routes

    Route::resource('admin/tag', 'TagController');
    
    Route::get('admin/tag/{tag}', 'TagController@tag')->name('admin.tag');

    // Category Routes

    Route::resource('admin/category', 'CategoryController');

    Route::get('admin/category/{category}', 'CategoryController@category')->name('admin.category');

    // Roles Routes

    Route::resource('admin/role', 'RoleController');

    // Permissions Routes

    Route::resource('admin/permission', 'PermissionController');

    // Email Routes
    Route::resource('admin/email', 'EmailController');

    // Admin auth routes

    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');

    Route::post('admin-login', 'Auth\LoginController@login');

    Route::post('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');

});

Route::get('ajax-pagination',array('as'=>'ajax.pagination','uses'=>'HomeController@ajaxPagination'));



Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
