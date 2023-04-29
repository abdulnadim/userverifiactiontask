<?php

use Illuminate\Support\Facades\Route;
use App\Models\Products;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[App\Http\Controllers\AdminController::class,'index']);
Route::post('/admin/auth',[App\Http\Controllers\AdminController::class,'auth'])->name('admin.auth');

// Route::group(['middleware'=>'admin_auth'],function(){
Route::get('/admin/dashboard',[App\Http\Controllers\AdminController::class,'dashboard']);


Route::get('/admin/user',[App\Http\Controllers\UserController::class,'index']);
Route::post('/admin/adduser',[App\Http\Controllers\UserController::class,'createuser']);
Route::get('/admin/manage_user/{id?}',[App\Http\Controllers\UserController::class,'manage_user']);
Route::post('/admin/user_manage_process/{id?}',[App\Http\Controllers\UserController::class,'user_manage_process'])->name('user.insert');
Route::get('/admin/user/delete/{id}',[App\Http\Controllers\UserController::class,'delete']);
// Route::get('/admin/user/status/{status}/{id}',[App\Http\Controllers\UserController::class,'status']);
Route::get('/user/email/verifyEmail/{email?}/{token?}',[App\Http\Controllers\UserController::class,'verifyEmail']);



Route::get('/admin/logout',function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error', 'logout successfully');
    return redirect('/admin');

});

// });
