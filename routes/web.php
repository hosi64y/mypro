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


Route::prefix('administrator')->group(function (){
   Route::get('/','Backend\mainController@mainPage');
   Route::resource('/categories','Backend\categoryController');
   Route::resource('/attributes_group','Backend\attributeGroupController');
   Route::resource('/attributes_value','Backend\attributeValueController');
   Route::resource('/brands','Backend\brandController');
   Route::resource('/photos','Backend\photoController');
   Route::post('/upload','Backend\photoController@upload')->name('photo_upload');
});