@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
            @csrf

            <div class="form-group row">
                <label class="col-2 col-form-label">Tanggal</label>
                <div class="col-10">
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Pelanggan</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="pelanggan" value="{{ old('pelanggan') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Total</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="total" value="{{ old('total') }}" required min="0">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection