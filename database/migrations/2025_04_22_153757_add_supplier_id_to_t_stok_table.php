<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierIdToTStokTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_stok', function (Blueprint $table) {
            if (!Schema::hasColumn('t_stok', 'supplier_id')) {
                $table->bigInteger('supplier_id')->unsigned()->nullable(false);
            }
        });
    }
    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_stok', function (Blueprint $table) {
            $table->dropColumn('supplier_id');
        });
    }
}
