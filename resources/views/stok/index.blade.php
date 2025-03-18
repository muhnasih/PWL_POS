@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Stok</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="supplier_id" name="supplier_id">
                            <option value="">- Semua Supplier -</option>
                            @foreach($supplier as $item)
                                <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan supplier</small>
                    </div>
                    <div class="col-3">
                        <select class="form-control" id="barang_id" name="barang_id">
                            <option value="">- Semua Barang -</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan barang</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Diinput Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('js')
<script>
  
    var dataStok;
    $(document).ready(function () {
         dataStok = $('#table_stok').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('stok/list') }}",
                type: "POST",
                data: function (d) {
                    d.supplier_id = $('#supplier_id').val();
                    d.barang_id = $('#barang_id').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
               
                { data: 'barang.barang_nama', orderable: true, searchable: true },
                { data: 'stok_jumlah', className: 'text-center' },
                { data: 'stok_tanggal', className: 'text-center' },
                { data: 'user.nama', orderable: false },
                { data: 'aksi', orderable: false, searchable: false }
            ]
        });

        $('#supplier_id, #barang_id').on('change', function () {
            dataStok.ajax.reload();
        });
    });
</script>
@endpush
