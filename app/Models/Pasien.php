<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    public $timestamps = false;

    protected $fillable = [
        'nama_pasien',
        'usia',
        'email',
        'alamat',
    ];
        // Relasi ke Konsultasi
    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'id_pasien', 'id_pasien');
    }
}

