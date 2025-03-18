@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Penjualan</h3>
    </div>
    <div class="card-body">
        @empty($penjualan)
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data tidak ditemukan.
            </div>
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('penjualan/'.$penjualan->id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-2 col-form-label">Tanggal</label>
                    <div class="col-10">
                        <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $penjualan->tanggal) }}" required>
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Pelanggan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="pelanggan" value="{{ old('pelanggan', $penjualan->pelanggan) }}" required>
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Total</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="total" value="{{ old('total', $penjualan->total) }}" required min="0">
                    </div>
                </div>  

                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection