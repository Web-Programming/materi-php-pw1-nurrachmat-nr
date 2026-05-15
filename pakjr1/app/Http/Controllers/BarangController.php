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
    
    //detail/show
    function show($id){
        $barang = Barang::findOrFail($id);
        return view("barang.detail", [
            'title' => 'Detail Barang',
            'barang' => $barang
        ]);
    }

    //create
    function create(){
        return view("barang.create", ['title' => 'Tambah Barang']);
    }


    //store
    function store(Request $request){
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'harga' => 'required|numeric|min:0',
            'tgl_input' => 'nullable|date',
        ]);

        Barang::insert($validated);

        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan.');
    }

    //edit
    function edit($id){
        $barang = Barang::findOrFail($id);

        return view("barang.edit", [
            'title' => 'Edit Barang',
            'barang' => $barang,
        ]);
    }

    //update
    function update(Request $request, $id){
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:0',
            'status' => 'required|boolean',
            'harga' => 'required|numeric|min:0',
            'tgl_input' => 'nullable|date',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($validated);

        return redirect('/barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    //delete
    function destroy($id){
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect('/barang')->with('success', 'Data barang berhasil dihapus.');
    }
   
}
