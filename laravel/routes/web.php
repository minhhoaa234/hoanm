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
use Illuminate\Routing\Router;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/logout', function(){
    Auth::logout();
     return Redirect::to('login');
})->name('logout');
//Hiển thị user
Route::middleware(['auth'])->group(function(){
Route::get('users','UserController@show')->name('user');
// Route::middleware(['checkAdmin'])->group(function(){

// thêm sửa xóa user
Route::get('showUsers/{id?}/{del?}','UserController@showUsers'); 
Route::post('user','UserController@store');

//Hiển thị user Banks
Route::get('banks','UserController@showBanks');

//thêm sửa xóa  bank
Route::get('show/{id?}/{del?}','UserController@Banks');
Route::post('storeBanks','UserController@storeBank');
//thay đổi chi nhánh theo bank
Route::get('getBranch/{id?}', 'UserController@getBranch');
//xuất exel
Route::get('export', 'ExportController@export')->name('export');

// });
});
