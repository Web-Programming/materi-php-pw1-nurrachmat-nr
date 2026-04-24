<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    echo "Hello Dina";
});

//Buat halaman profil
Route::get('/profil', function () {
    echo "Nama : Dina Salsabila <br>";
    echo "NPM : 123456789 <br>";
});

//Route dengan parameter
//Test dengan mengakses http://pakjr1.test/biodata/Enzo/123456789
Route::get('/biodata/{nama}/{npm}', function ($nama, $npm) {
    echo "Nama : " . $nama . "<br>";
    echo "NPM : " . $npm . "<br>";
});