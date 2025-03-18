@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Stok</h3>
        </div>
        <div class="card-body">
            @if(empty($stok))
                <div class="alert alert-danger">Data stok tidak ditemukan.</div>
            @else
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $stok->stok_id }}</td>
                    </tr>
                   
                    <tr>
                        <th>Barang</th>
                        <td>{{ $stok->barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $stok->stok_jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $stok->stok_tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Diinput Oleh</th>
                        <td>{{ $stok->user->nama }}</td>
                    </tr>
                </table>
                <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @endif
        </div>
    </div>
@endsection