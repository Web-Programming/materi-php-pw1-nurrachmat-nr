<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Cara Menginsert Data :
        //Cara 1
        Barang::insert([
            'nama_barang' => 'Mie Instant',
            'jumlah' => 12,
            'status' => 1,
            'harga' => '3000',
            'tgl_input' => date("Y-m-d")
        ]);

        //Cara 2
        $barangbaru = new Barang();
        $barangbaru->nama_barang = "Air Mineral";
        $barangbaru->jumlah = "24";
        $barangbaru->status = 1;
        $barangbaru->harga = 4000;
        $barangbaru->tgl_input = "2026-05-01";
        $barangbaru->save();

        //Cara Update Data
        Barang::where("nama_barang", "Mie Instant")
        ->update(['harga' => '3500']);

        //Cara Delete Data
        Barang::where("harga", 4000)->delete();
    }
}
