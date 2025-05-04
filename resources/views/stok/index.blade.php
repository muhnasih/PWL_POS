@extends('layouts.template')

@section('content')
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
        <h3 class="mb-0">{{ $page->title }}</h3>
        <div class="d-flex gap-2">
            <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-outline-light">
                <i class="fa fa-upload me-1"></i> Import
            </button>
            <a href="{{ url('/stok/export_excel') }}" class="btn btn-outline-light">
                <i class="fa fa-file-excel me-1"></i> Excel
            </a>
            <a href="{{ url('/stok/export_pdf') }}" class="btn btn-outline-light">
                <i class="fa fa-file-pdf me-1"></i> PDF
            </a>
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-outline-light">
                <i class="fa fa-plus me-1"></i> Tambah (Ajax)
            </button>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success rounded-pill text-center">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger rounded-pill text-center">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center" id="table_stok">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Diinput Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
{{-- Optional Custom Style --}}
<style>
    .card-header h3 {
        font-size: 1.25rem;
    }

    .btn-outline-light {
        border-color: white;
        color: white;
    }

    .btn-outline-light:hover {
        background-color: white;
        color: #0d6efd;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding: 0.4rem 1rem;
    }
</style>
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataStok;

    $(document).ready(function() {
        dataStok = $('#table_stok').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('stok/list') }}",
                type: "POST",
                data: function(d) {
                    d.barang_id = $('#barang_id').val();
                    d.user_id = $('#user_id').val();
                    d.supplier_id = $('#supplier_id').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: 'supplier.supplier_nama', render: (data, type, row) => row.supplier ? row.supplier.supplier_nama : 'Terjual' },
                { data: "barang.barang_nama" },
                { data: "stok_jumlah" },
                { data: "stok_tanggal" },
                { data: "user.username" },
                { data: "aksi", orderable: false, searchable: false }
            ]
        });

        $('#barang_id, #user_id, #supplier_id').on('change', function() {
            dataStok.ajax.reload();
        });

        $('#table_stok_filter input').unbind().bind().on('keyup', function(e) {
            if (e.keyCode == 13) {
                dataStok.search(this.value).draw();
            }
        });
    });
</script>
@endpush
