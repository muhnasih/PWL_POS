@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data penjualan yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')

        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Penjualan</label>
                        <input value="{{ $penjualan->penjualan_kode }}" type="text" class="form-control" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Pembeli</label>
                        <input value="{{ $penjualan->pembeli }}" type="text" name="pembeli" id="pembeli" class="form-control" required>
                        <small id="error-pembeli" class="error-text form-text text-danger"></small>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Penjualan</label>
                        <input value="{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('d/m/Y H:i') }}" type="text" class="form-control" readonly>
                    </div>
                    
                    <hr>
                    <h5>Detail Barang</h5>
                    <div id="detail-container">
                        @foreach($penjualan->penjualanDetail as $index => $detail)
                        <div class="detail-item row mb-3" data-index="{{ $index }}">
                            <div class="col-md-5">
                                <label>Barang</label>
                                <select class="form-control barang-select" name="details[{{ $index }}][barang_id]" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $item)
                                        <option value="{{ $item->barang_id }}" 
                                            {{ $detail->barang_id == $item->barang_id ? 'selected' : '' }}
                                            data-harga="{{ $item->harga_jual }}">
                                            {{ $item->barang_nama }} (Stok: {{ $item->barang_stok }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Jumlah</label>
                                <input type="number" class="form-control jumlah" 
                                       name="details[{{ $index }}][jumlah]" 
                                       value="{{ $detail->jumlah }}" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label>Harga</label>
                                <input type="number" class="form-control harga" 
                                       name="details[{{ $index }}][harga]" 
                                       value="{{ $detail->harga }}" required>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-danger btn-block hapus-detail" 
                                        style="margin-top: 32px;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <button type="button" id="tambah-detail" class="btn btn-secondary">
                        <i class="fa fa-plus"></i> Tambah Barang
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Tambah detail barang
            $('#tambah-detail').click(function() {
                const index = Date.now();
                const newDetail = `
                    <div class="detail-item row mb-3" data-index="${index}">
                        <div class="col-md-5">
                            <select class="form-control barang-select" name="details[${index}][barang_id]" required>
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item->barang_id }}" data-harga="{{ $item->harga_jual }}">
                                        {{ $item->barang_nama }} (Stok: {{ $item->barang_stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control jumlah" name="details[${index}][jumlah]" min="1" value="1" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control harga" name="details[${index}][harga]" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-block hapus-detail">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                $('#detail-container').append(newDetail);
            });

            // Hapus detail barang
            $(document).on('click', '.hapus-detail', function() {
                if ($('.detail-item').length > 1) {
                    $(this).closest('.detail-item').remove();
                } else {
                    alert('Minimal harus ada satu detail barang');
                }
            });

            // Update harga ketika barang dipilih
            $(document).on('change', '.barang-select', function() {
                const selectedOption = $(this).find('option:selected');
                const harga = selectedOption.data('harga');
                $(this).closest('.detail-item').find('.harga').val(harga);
            });

            // Validasi form
            $("#form-edit").validate({
                rules: {
                    pembeli: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    "details[*][barang_id]": {
                        required: true
                    },
                    "details[*][jumlah]": {
                        required: true,
                        min: 1
                    },
                    "details[*][harga]": {
                        required: true,
                        min: 1
                    }
                },
                messages: {
                    pembeli: {
                        required: "Nama pembeli harus diisi",
                        minlength: "Minimal 3 karakter",
                        maxlength: "Maksimal 100 karakter"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                datapenjualan.ajax.reload(); // Ganti dengan variabel DataTables Anda
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal menyimpan data. Silakan coba lagi.'
                            });
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty