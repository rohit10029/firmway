<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
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

Route::get('/', [UserController::class, 'home']);
Route::get('/login',[ 'as' => 'login', 'uses' => function () {
    return view('signup');
}]);

Route::post('/join',[UserController::class, 'login'] );

Route::post('/signup',  [UserController::class, 'Signup']);
Route::post('/blog-subscribe',  [UserController::class, 'blogSubscribe']);

Route::get('/blog',[ BlogController::class, 'blogForm'] );
Route::get('/blog-update/{id}',[ BlogController::class, 'blogUpdate'] )->where(['id'=>"[0-9]+"]);
Route::get('/blog-view/{id}',[ BlogController::class, 'blogView'] )->where(['id'=>"[0-9]+"]);
Route::get('/blog-publish/{id}',[ BlogController::class, 'blogPublish'] )->where(['id'=>"[0-9]+"]);
Route::post('/blog-post/{id?}',  [BlogController::class, 'blogSubmit']);