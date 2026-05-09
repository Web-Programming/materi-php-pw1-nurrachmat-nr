@extends('app.master')
@section('title', $title)
@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>{{ $title }}</h1>
        <a href="{{ url('/barang') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ url('/barang/update/' . $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah) }}" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ (string) old('status', $barang->status) === '1' ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ (string) old('status', $barang->status) === '0' ? 'selected' : '' }}>Tidak tersedia</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $barang->harga) }}" min="0" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="tgl_input" class="form-label">Tanggal Input</label>
                    <input type="date" class="form-control" id="tgl_input" name="tgl_input" value="{{ old('tgl_input', $barang->tgl_input) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/barang') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection