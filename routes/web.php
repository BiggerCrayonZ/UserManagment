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

//Ruta principal
Route::get('/', function () {
    return view('welcome');
});

//Rutas predeterminadas para los metodos de la clase Auth
Auth::routes();
//Ruta para cerrar sesion
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Rutas para la administración de los usuarios
Route::group(['prefix' => 'admin'], function(){

    Route::resource('users', 'UsersController');
    Route::get('users/{id}/destroy',[
        'uses'  =>  'UsersController@destroy',
        'as'    =>  'admin.users.destroy'
    ]);

});

//Método Home preautorizado por el middleware the Auth
Route::get('/home', 'HomeController@index')->middleware('auth');

//Rutas destinadas al comportamiento de las imagenes de perfil
Route::get('/profile', 'UsersController@profile')->name('user.profile');
Route::patch('/profile', 'UsersController@update_profile')->name('user.profile.update');
