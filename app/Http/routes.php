<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\MyAuth@auth');



//регистрация с потдверждением email
Route::post('auth/register','AdvancedReg@register');

Route::get('register/confirm/{token}','AdvancedReg@confirm');


Route::get('repeat_confirm','AdvancedReg@getRepeat');
Route::post('repeat_confirm','AdvancedReg@postRepeat');
//регистрация с потдверждением email



//восстановление пароля 

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Роуты сброса пароля
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



Route::get('auth/logout', 'Auth\AuthController@getLogout');
//Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register','Auth\AuthController@postRegister');

//обновление картинки капчи

Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
    return $captcha->src($config);
});

Route::get('/', 'HomePageController@index');

Route::get('lk', 'LkController@index');

Route::get('/add', 'WorkerController@index');

Route::post('add', 'WorkerController@store');

Route::get('worker/{id}', 'WorkerController@view');

Route::post('timestart', 'WorkerController@timestart');

Route::post('timestop', 'WorkerController@timestop');

Route::get('workers', 'WorkerController@viewAll');




