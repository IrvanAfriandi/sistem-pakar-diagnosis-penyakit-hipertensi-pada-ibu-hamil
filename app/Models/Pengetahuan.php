<?php

// File: app/Models/Pengetahuan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengetahuan extends Model
{
    use HasFactory;

    protected $table = 'basis_pengetahuan';
    protected $primaryKey = 'id_pengetahuan';
    
    protected $fillable = [
        'id_penyakit',
        'id_gejala',
        'cf_pakar'
    ];

    protected $casts = [
        'cf_pakar' => 'float'
    ];

    // Relasi ke Penyakit
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit', 'id_penyakit');
    }

    // Relasi ke Gejala  
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'id_gejala', 'id_gejala');
    }

    // Scope untuk CF tinggi
    public function scopeHighCF($query)
    {
        return $query->where('cf_pakar', '>', 0.7);
    }

    // Scope untuk penyakit tertentu
    public function scopeForDisease($query, $diseaseId)
    {
        return $query->where('id_penyakit', $diseaseId);
    }

    // Scope untuk gejala tertentu
    public function scopeForSymptom($query, $symptomId)
    {
        return $query->where('id_gejala', $symptomId);
    }
}