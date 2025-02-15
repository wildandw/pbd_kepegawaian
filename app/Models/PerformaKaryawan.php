<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformaKaryawan extends Model
{
    use HasFactory;

    protected $table = 'papan_peringkat';
    protected $primaryKey = 'id_karyawan';
    public $incrementing = false; // Karena primary key adalah VARCHAR
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'skor_akhir',
        'peringkat',
    ];

    // Relasi ke tabel karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
    
}

