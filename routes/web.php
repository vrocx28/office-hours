<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// admin routes
Route::get('/adminlogin','AdminController@adminLogin')->name('adminlogin');
Route::post('/admin-post','AdminController@adminLoginPost')->name('admin-post');
Route::group(['prefix'=>'/', 'middleware' => 'admin'], function(){
    Route::get('/admin','AdminController@adminDashboard')->name('admin');
    Route::get('/logout','AdminController@logout')->name('logout');
    Route::get('/add-employee','AdminController@addEmployee')->name('add-employee');
    Route::post('/employee-post','AdminController@employeePost')->name('employee-post');
    Route::post('/peremail-post','AdminController@verifyperemail')->name('peremail-post');
    Route::post('/email-post','AdminController@verifyemail')->name('email-post');
    Route::get('/get-city-list', 'AdminController@getCityList')->name('get-city-list');
    Route::get('/view-employee', 'AdminController@viewEmployee')->name('view-employee');
});

// user routes
Route::get('/login','UserController@userLogin')->name('login');
Route::post('/user-post','UserController@userLoginPost')->name('user-post');
Route::group(['prefix'=>'/', 'middleware' => 'emp'], function(){
    Route::get('/dashboard','UserController@userDashboard')->name('dashboard');
    Route::get('/emplogout','UserController@empLogout')->name('emplogout');
});

Route::get('/populate-state-city-data','StateCityController@savestatecity')->name('populate-state-city-data');