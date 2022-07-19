<?php
use App\Http\Middleware\AdminCheck;
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
Route::middleware([AdminCheck::class])->group(function(){
//start routes of tags
Route::get('/get_tags', 'App\Http\Controllers\Admincontroller@getTag');


Route::post('/create_tag', 'App\Http\Controllers\Admincontroller@addTag');


Route::post('/edit_tag', 'App\Http\Controllers\Admincontroller@editTag');


Route::post('/delete_tag', 'App\Http\Controllers\Admincontroller@deleteTag');
//end route of the tags


//start routes of the categories

Route::get('/get_categories', 'App\Http\Controllers\Admincontroller@getCategory');

Route::post('upload', 'App\Http\Controllers\Admincontroller@upload');

Route::post('delete_image', 'App\Http\Controllers\Admincontroller@deleteImage');

Route::post('create_category', 'App\Http\Controllers\Admincontroller@addCategory');

Route::post('/delete_category', 'App\Http\Controllers\Admincontroller@deleteCategory');


Route::post('/edit_category', 'App\Http\Controllers\Admincontroller@editCategory');


//end routes of the categories


//admin
Route::post('/create_user', 'App\Http\Controllers\Admincontroller@createUser');
    Route::get('/get_users', 'App\Http\Controllers\Admincontroller@getUsers');
    Route::post('/edit_user', 'App\Http\Controllers\Admincontroller@editUser');
//
});
Route::post('/admin_login', 'App\Http\Controllers\Admincontroller@adminLogin');

 Route::get('/logout', 'App\Http\Controllers\Admincontroller@logout');
Route::get('/', 'App\Http\Controllers\Admincontroller@index');
//Route::any('{slug}', 'App\Http\Controllers\Admincontroller@index')->where('slug','([A-z\d\/_.]+)?'); 

// Route::get('/', function () {
//     return view('welcome');
// });


Route::any('{slug}',function(){
    return view('welcome');
});