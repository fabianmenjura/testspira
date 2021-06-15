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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/indexCourses', [App\Http\Controllers\HomeController::class, 'indexCourses'])->name('indexcourses');
Route::get('/index_curso_usuario', [App\Http\Controllers\HomeController::class, 'index_curso_usuario'])->name('index_curso_usuario');

Route::apiResource('/curso_usuarios', App\Http\Controllers\CursoUsuarioController::class);
Route::apiResource('/usuarios', App\Http\Controllers\UsuarioController::class);
Route::apiResource('/courses', App\Http\Controllers\CourseController::class);
