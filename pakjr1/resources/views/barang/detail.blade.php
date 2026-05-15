@extends('app.master')
@section('title', $title)
@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>{{ $title }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ url('/barang/edit/' . $barang->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ url('/barang') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Barang</label>
                    <div class="form-control bg-light">{{ $barang->nama_barang }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jumlah</label>
                    <div class="form-control bg-light">{{ $barang->jumlah }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Status</label>
                    <div class="form-control bg-light">
                        @if ($barang->status)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Harga</label>
                    <div class="form-control bg-light">Rp {{ number_format($barang->harga, 0, ',', '.') }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Input</label>
                    <div class="form-control bg-light">{{ $barang->tgl_input ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection