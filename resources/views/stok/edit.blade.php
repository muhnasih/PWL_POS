@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Stok</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($stok)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('stok/'.$stok->stok_id) }}" class="form-horizontal">
                @csrf
                @method('PUT') <!-- Gunakan method PUT untuk update -->
                    
                <div class="form-group row">
                    <label class="col-2 col-form-label">Supplier</label>
                    <div class="col-10">
                        <select class="form-control" name="supplier_id" required>
                            <option value="">Pilih Supplier</option>
                            @foreach($supplier as $item)
                                <option value="{{ $item->supplier_id }}" 
                                    {{ $stok->supplier_id == $item->supplier_id ? 'selected' : '' }}>
                                    {{ $item->supplier_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Barang</label>
                    <div class="col-10">
                        <select class="form-control" name="barang_id" required>
                            <option value="">Pilih Barang</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}" 
                                    {{ $stok->barang_id == $item->barang_id ? 'selected' : '' }}>
                                    {{ $item->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Jumlah</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="stok_jumlah" 
                            value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" required min="1">
                        @error('stok_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Tanggal Stok</label>
                    <div class="col-10">
                        <input type="datetime-local" class="form-control" name="stok_tanggal" 
                            value="{{ old('stok_tanggal', \Carbon\Carbon::parse($stok->stok_tanggal)->format('Y-m-d\TH:i')) }}" required>
                        @error('stok_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label">Diinput Oleh</label>
                    <div class="col-10">
                        <select class="form-control" name="user_id" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $item)
                                <option value="{{ $item->user_id }}" 
                                    {{ $stok->user_id == $item->user_id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-2 col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('stok') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
