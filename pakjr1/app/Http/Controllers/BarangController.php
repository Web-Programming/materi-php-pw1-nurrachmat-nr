<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    function index(){
        $listbarang = Barang::all(); //select * from barangs
        $title = "Daftar Barang";
        //return view("barang.index", compact($listbarang, $title));
        return view("barang.index", 
            [
                "listbarang" => $listbarang, 
                "title" => $title
            ]
        );
    }
}
