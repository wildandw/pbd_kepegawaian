<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Asesor extends Authenticatable {
    protected $table = 'performa_karyawan.asesor';
    protected $primaryKey = 'id_asesor';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];
}