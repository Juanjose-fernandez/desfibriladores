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


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/logout', function () {
    Auth::logout();
    return view('auth/login');
});

//Rutas de autenticación
Auth::routes(['verify' => true]);
//TODAS LAS RUTAS DEBEN TENER EL MIDDLEWARE DE AUTH
Route::group(['middleware' => 'auth'], function () {
    //Index
    Route::get('/', 'HomeController@index');
    //Home
    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'],  function() {

        //Gestión de usuarios (Webmaster)
        Route::group(['prefix' => 'user','middleware' => ['role:webmaster'], 'as'=>'user.'], function () {
            Route::get('/list', 'User\UserController@getList')->name('list');
            Route::put('/restore', 'User\UserController@restore')->name('restore');
        });
        Route::resource('user', 'User\UserController');


        // Clientes
        Route::group(['prefix' => 'client'  ,'as'=>'client.'],  function() {
            Route::get('/data', 'ClientController@data')->name('data');
        });
        Route::resource('client','ClientController');


    });
    //Perfil
    Route::get('/profile', 'User\ProfileController@getProfile');
    Route::post('/profile/update-info', 'User\ProfileController@postUpdateBasicInfo');
    Route::post('/profile/update-pass', 'User\ProfileController@postUpdatePassword');



});


Route::get('/users/confirmation/{token}', 'Auth\RegisterController@getConfirmationUser')->name('confirmation');


Route::get('/inputs', function () {
    return view('site/input-examples/inputs');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
Route::get('/prepare', function () {

    //$exitCode = \Artisan::call('storage:link');
    //$exitCode = \Artisan::call('config:clear');
    //$exitCode = \Artisan::call('cache:clear');
});
*/

