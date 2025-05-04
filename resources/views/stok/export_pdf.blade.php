<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .border-bottom-header {
            border-bottom: 1px solid;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center"><img src="{{ asset('img/logo-polinema.png')}}" width="100" height="100"></td>
            <td>
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
            </td>
        </tr>
    </table>
    <h3 class="text-center">LAPORAN DATA STOK</h3>
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Supplier</th> <!-- Menambahkan kolom Supplier -->
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Masuk</th>
                <th>Diinput Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stok as $s)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $s->supplier->supplier_nama ?? 'Tidak Ada Supplier' }}</td> <!-- Menampilkan nama supplier -->
                    <td>{{ $s->barang->barang_nama ?? 'Tidak Ada Barang' }}</td> <!-- Menampilkan nama barang -->
                    <td>{{ $s->stok_jumlah }}</td>
                    <td>{{ $s->stok_tanggal }}</td> <!-- Tanggal masuk -->
                    <td>{{ $s->user->nama }}</td> <!-- Diinput oleh pengguna -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
