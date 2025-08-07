<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    protected $primaryKey = 'id_konsultasi';
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'hasil_diagnosis',
        'tingkat_kayakinan',
    ];
// Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke Detail Konsultasi - INI YANG PENTING!
    public function detail_konsultasi()
    {
        return $this->hasMany(DetailKonsultasi::class, 'id_konsultasi', 'id_konsultasi');
    }

    // Relasi ke Detail Konsultasi dengan Gejala (optional, tapi berguna)
    public function detail_konsultasi_with_gejala()
    {
        return $this->hasMany(DetailKonsultasi::class, 'id_konsultasi', 'id_konsultasi')
                    ->with('gejala');
    }
}

