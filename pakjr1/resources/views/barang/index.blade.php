@extends('app.master')
@section('title', $title)
@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>{{ $title }}</h1>
        <a href="{{ url('/barang/create') }}" class="btn btn-primary">Tambah Barang</a>
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
                                <a href="{{ url('/barang/edit/' . $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ url('/barang/' . $item->id) }}" method="POST" onsubmit="return confirmDelete('{{ addslashes($item->nama_barang) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
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