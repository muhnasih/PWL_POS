@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary shadow-sm rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top">
            <h3 class="mb-0">{{ $page->title }}</h3>
            <div class="d-flex gap-2">
              
                </button>
                <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-primary">
                    <i class="fa fa-file-excel me-1"></i> Export Penjualan
                </a>
                <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-warning">
                    <i class="fa fa-file-pdf me-1"></i> Export Penjualan
                </a>
                <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-success">
                    <i class="fa fa-plus me-1"></i> Tambah Data (Ajax)
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
                <table class="table table-bordered table-striped table-hover table-sm align-middle text-center" id="table_penjualan">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Kode Penjualan</th>
                            <th>Pembeli</th>
                            <th>Kasir</th>
                            <th>Tanggal</th>
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
<style>
    .card-header h3 {
        font-size: 1.25rem;
    }

    /* Sesuaikan tombol dengan warna tema penjualan */
    .btn-info, .btn-primary, .btn-warning, .btn-success {
        border-radius: 0.25rem;
    }

    /* Styling input search DataTables */
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

    var dataPenjualan;

    $(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('penjualan/list') }}",
                type: "POST",
                data: function(d) {
                    d.user_id = $('#user_id').val(); // Jika ada filter user_id
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "penjualan_kode", orderable: true, searchable: true },
                { data: "pembeli", orderable: true, searchable: true },
                { data: "user", orderable: false, searchable: true },
                { data: "penjualan_tanggal", orderable: true, searchable: true },
                { data: "aksi", orderable: false, searchable: false }
            ]
        });

        // Jika ada filter user_id, bisa ditambahkan event change seperti ini:
        $('#user_id').on('change', function() {
            dataPenjualan.ajax.reload();
        });

        // Search on Enter key only
        $('#table_penjualan_filter input').unbind().bind('keyup', function(e) {
            if (e.keyCode == 13) {
                dataPenjualan.search(this.value).draw();
            }
        });
    });
</script>
@endpush
