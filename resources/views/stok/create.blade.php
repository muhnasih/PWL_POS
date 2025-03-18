@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Stok</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('stok') }}">
            @csrf
            <div class="form-group">
                <label>Supplier</label>
                <select class="form-control" name="supplier_id" required>
                    <option value="">Pilih Supplier</option>
                    @foreach($supplier as $item)
                        <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Barang</label>
                <select class="form-control" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="stok_jumlah" required min="1">
            </div>
            <div class="form-group">
                <label>Tanggal Stok</label>
                <input type="datetime-local" class="form-control" name="stok_tanggal" required>
            </div>
            <div class="form-group">
                <label>Diinput Oleh</label>
                <select class="form-control" name="user_id" required>
                    <option value="">Pilih User</option>
                    @foreach($users as $item)
                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
