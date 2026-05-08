@extends('app.master')
@section('title', $title)
@section('sidebar')
    @parent
@endsection

@section('content')
    <h1>{{ $title }}</h1>
    Buat form untuk menginsert data Barang
@endsection