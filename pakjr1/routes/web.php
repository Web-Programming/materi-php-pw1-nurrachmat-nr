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

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;

//Route::get("/barang", BarangController::class ."@index");
Route::get("/barang", [BarangController::class, "index"]);
Route::get("/barang/create", [BarangController::class, "create"]);
Route::get("/barang/{id}", [BarangController::class, "show"]);
Route::get("/barang/edit/{id}", [BarangController::class, "edit"]);
Route::post("/barang", [BarangController::class, "store"]);
Route::put("/barang/update/{id}", [BarangController::class, "update"]);
Route::delete("/barang/{id}", [BarangController::class, "destroy"]);


Route::resource("customer", CustomerController::class);