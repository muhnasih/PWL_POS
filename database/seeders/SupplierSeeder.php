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
            ['nama_supplier' => 'PT Elektronik Jaya', 'alamat' => 'Jakarta'],
            ['nama_supplier' => 'Toko Pakaian Makmur', 'alamat' => 'Bandung'],
            ['nama_supplier' => 'Distributor Makanan Sehat', 'alamat' => 'Surabaya'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
