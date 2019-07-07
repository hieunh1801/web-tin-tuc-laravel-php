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
    return view('welcome');
});

Route::get('/checkdatabase', function() {
    $theloai = App\TheLoai::All();
    foreach($theloai as $value) {
        echo $value;
    }
});

Route::get('/checkpage', function () {
    return view('admin.theloai.danhsach');
});