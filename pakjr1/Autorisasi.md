# Materi Authorization di Laravel

## Pengantar
Authorization adalah proses untuk menentukan apakah user memiliki hak akses untuk melakukan aksi tertentu pada aplikasi. Laravel menyediakan dua cara utama untuk mengimplementasikan authorization:
1. **Gates** - Closure-based authorization
2. **Policies** - Class-based authorization untuk model tertentu

## Persiapan

### 1. Pastikan Authentication Sudah Berjalan
Pastikan sistem authentication sudah dikonfigurasi.

### 2. Tambahkan Kolom Role pada Tabel Users
Jika ingin membedakan role user:

```bash
php artisan make:migration add_role_to_users_table
```

Edit migration:
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user'); // admin, user, editor, dll
    });
}
```

Jalankan migration:
```bash
php artisan migrate
```

---

## BAGIAN 1: Menggunakan Gates

### Langkah 1: Mendefinisikan Gates

Buat Provider dengan nama AuthServiceProvider 
menggunakan perintah 
`php artisan make:provider AuthServiceProvider`

File akan dibuat di `app/Providers/AuthServiceProvider.php`:

```php
<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // akan kita isi nanti untuk Policy
    ];

    public function boot(): void
    {
        // Gate untuk mengecek apakah user adalah admin
        Gate::define('manage-barang', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk update barang (bisa admin atau owner)
        Gate::define('update-barang', function (User $user, Barang $barang) {
            return $user->role === 'admin' || $user->id === $barang->user_id;
        });

        // Gate untuk delete barang (hanya admin)
        Gate::define('delete-barang', function (User $user, Barang $barang) {
            return $user->role === 'admin';
        });

        // Gate untuk create barang (user yang sudah login)
        Gate::define('create-barang', function (User $user) {
            return $user !== null;
        });
    }
}
```

### Langkah 2: Menggunakan Gates di Controller

Edit `BarangController.php`:

```php
use Illuminate\Support\Facades\Gate;

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
    // Cek authorization menggunakan Gate
    Gate::authorize('create-barang');
    return view("barang.create", ['title' => 'Tambah Barang']);
}


//store
function store(Request $request){
    // Cek authorization menggunakan Gate
    Gate::authorize('create-barang');
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
    Gate::authorize('update-barang', $product);
    $barang = Barang::findOrFail($id);

    return view("barang.edit", [
        'title' => 'Edit Barang',
        'barang' => $barang,
    ]);
}

//update
function update(Request $request, $id){
    Gate::authorize('update-barang', $product);
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
    Gate::authorize('delete-barang', $product);
    $barang->delete();
    return redirect('/barang')->with('success', 'Data barang berhasil dihapus.');
}
```

### Langkah 3: Menggunakan Gates di Blade Template

Edit view `barang/index.blade.php`(BAGIAN @section('content')):

```blade
@section('content')
<div class="d-flex justify-content-between align-items-center mt-4 mb-3">
    <h1>{{ $title }}</h1>

    @can('create-product')
        <a href="{{ url('/barang/create') }}" class="btn btn-primary">Tambah Barang</a>
    @endcan
    
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listbarang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        @if ($item->status)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->tgl_input ?? '-' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/barang/' . $item->id) }}" class="btn btn-sm btn-success">Detail</a>
                            @can('update-product', $product)
                            <a href="{{ url('/barang/edit/' . $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('delete-product', $product)
                            <form action="{{ url('/barang/' . $item->id) }}" method="POST" onsubmit="return confirmDelete('{{ addslashes($item->nama_barang) }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data barang belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(namaBarang) {
        return confirm('Yakin ingin menghapus barang: ' + namaBarang + '?');
    }
</script>
@endsection
```