<h1>{{ $title }}</h1>
@foreach ($listbarang as $item)
    <li> {{$item->nama_barang}} | {{ $item->harga }}</li>
@endforeach