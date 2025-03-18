<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_kode' => 'EKJ','supplier_nama' => 'PT Elektronik Jaya', 'supplier_alamat' => 'Jakarta'],
            ['supplier_kode' => 'TKP','supplier_nama' => 'Toko Pakaian Makmur', 'supplier_alamat' => 'Bandung'],
            ['supplier_kode' => 'DMS','supplier_nama' => 'Distributor Makanan Sehat', 'supplier_alamat' => 'Surabaya'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
