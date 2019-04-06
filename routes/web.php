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

Route::prefix('api')->group(function (){
    Route::get('admin/categories','Backend\categoryController@apiIndex');
//    Route::get('admin/attribute/{categoriesId}','Backend\categoryController@apiIndexAttribute');
    Route::post('admin/attribute','Backend\categoryController@apiIndexAttribute');

});
Route::prefix('administrator')->group(function (){
   Route::get('/','Backend\mainController@mainPage');
   Route::resource('/categories','Backend\categoryController');
   Route::resource('/attributes_group','Backend\attributeGroupController');
   Route::resource('/attributes_value','Backend\attributeValueController');
   Route::resource('/brands','Backend\brandController');
   Route::resource('/photos','Backend\photoController');
   Route::post('/photo/upload','Backend\photoController@upload')->name('photo_upload');
   Route::post('/photo/delete','Backend\photoController@delete')->name('photo_delete');
   Route::resource('/products','Backend\productController');
   Route::get('/categories/{id}/setting','Backend\categoryController@indexSetting')->name('categories.index_setting');
   Route::post('/categories/{id}/setting','Backend\categoryController@saveSetting')->name('categories.save_setting');

});




Auth::routes();

Route::get('/', 'Frontend\HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
