1. Membuat view dengan template bootstrap yang reusable
2. Membuat fitur CRUD (Create(create), Read (INDEX), Update(edit) dan Delete)
Untung fungsi buat data (create) membutuhkan:
Route : 1. barang/create -> menampilkan form
        2. barang/store -> menyimpan data ke tabel barang
View : 1. barang.create -> menampilkan form    


Untung fungsi read membutuhkan:
Route : 1. barang/index -> menampilkan list (semua) barang
        2. barang/show/{id} -> menampilkan detail barang
View : 1. barang.index -> menampilkan list    
       2. barang.detail -> menampilkan detail


Untung fungsi update data membutuhkan:
Route : 1. barang/edit/{id} -> menampilkan form edit
        2. barang/update -> menyimpan data ke tabel barang
View : 1. barang.edit -> menampilkan form edit 

Untung fungsi delete data membutuhkan:
Route : 1. barang/destroy/{id} -> menghapus data