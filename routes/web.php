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

Route::get('/', function () {
    return view('home');
});

Route::get('/header', function () {
    return view('header');
});

Route::get('/footer', function () {
    return view('footer');
});

Route::get('/datapasienbaru', function () {
    return view('datapasienbaru');
});

Route::get('/datapasienlama', function () {
    return view('datapasienlama');
});
// Route::get('/', function () {
//     return view('welcome');
// });
