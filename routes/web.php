<?php

use App\Http\Controllers\Controllers;
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

//start routes of tags
Route::get('/app/get_tags', 'App\Http\Controllers\Admincontroller@getTag');


Route::post('app/create_tag', 'App\Http\Controllers\Admincontroller@addTag');


Route::post('/app/edit_tag', 'App\Http\Controllers\Admincontroller@editTag');


Route::post('/app/delete_tag', 'App\Http\Controllers\Admincontroller@deleteTag');
//end route of the tags


//start routes of the categories

Route::get('/app/get_categories', 'App\Http\Controllers\Admincontroller@getCategory');

Route::post('app/upload', 'App\Http\Controllers\Admincontroller@upload');

Route::post('app/delete_image', 'App\Http\Controllers\Admincontroller@deleteImage');

Route::post('app/create_category', 'App\Http\Controllers\Admincontroller@addCategory');

Route::post('/app/delete_category', 'App\Http\Controllers\Admincontroller@deleteCategory');


Route::post('/app/edit_category', 'App\Http\Controllers\Admincontroller@editCategory');


//end routes of the categories


Route::get('/', function () {
    return view('welcome');
});


Route::any('{slug}',function(){
    return view('welcome');
});