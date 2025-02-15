<?php   
// App\Models\Karyawan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan'; // Set primary key ke id_karyawan
    public $incrementing = false; // Non-auto increment karena id_karyawan adalah string
    protected $keyType = 'string';
    public $timestamps = false;


    protected $fillable = [
        'id_karyawan',
        'nama',
        'posisi',
        'username',
        'password',
        'tanggal_masuk'
    ];

    protected static function booted()
    {
        static::creating(function ($karyawan) {
            if (empty($karyawan->tanggal_masuk)) {
                $karyawan->tanggal_masuk = now()->format('Y-m-d');
            }
        });
    }

    public function performa()
    {
        return $this->hasOne(PerformaKaryawan::class, 'id_karyawan', 'id');
    }
}
