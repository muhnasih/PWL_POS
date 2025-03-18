<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan'; // Nama tabel di database
    protected $primaryKey = 'penjualan_id'; // Primary key

    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal'
    ];

    public $timestamps = false; // Tidak menggunakan created_at & updated_at

    // Relasi ke UserModel
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi ke PenjualanDetailModel
    
}