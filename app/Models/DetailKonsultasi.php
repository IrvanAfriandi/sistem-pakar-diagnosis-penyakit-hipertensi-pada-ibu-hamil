<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKonsultasi extends Model
{
    protected $table = 'detail_konsultasi';
    protected $primaryKey = 'id_detail_konsultasi';
    public $timestamps = false;

    protected $fillable = [
        'id_konsultasi',
        'id_gejala',
    ];
    protected $casts = [
        'cf_pasien' => 'float'
    ];

    // Relasi ke Konsultasi
    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class, 'id_konsultasi', 'id_konsultasi');
    }

    // Relasi ke Gejala
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'id_gejala', 'id_gejala');
    }
}

