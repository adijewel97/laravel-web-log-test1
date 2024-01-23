<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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
    Log::info('Sukses : test info mang adis.');
    // Log::warning('Something could be going wrong.');
    // Log::error('Something is really going wrong.');

    return view('home', [
        'title' => 'Home'
    ]);
});


// Route::get('/about', function () {
//     return view('about', [
//         'title' => 'About'
//     ]);
// });

// Route::get('/blog', function () {
//     return view('blog', [
//         'title' => 'Blog'
//     ]);
// });
