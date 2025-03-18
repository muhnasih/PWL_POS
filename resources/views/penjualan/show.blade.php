@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if ($penjualan)
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $penjualan->id }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $penjualan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>{{ $penjualan->pelanggan }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                </tr>
            </table>
        @else
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data tidak ditemukan.
            </div>
        @endif

        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection