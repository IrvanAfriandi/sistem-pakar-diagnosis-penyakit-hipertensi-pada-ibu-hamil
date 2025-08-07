<?php
namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Pengetahuan;
use App\Models\DetailKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RiwayatKonsultasiController extends Controller
{
    public function index()
    {
        // Load konsultasi yang memiliki detail (bukan yang NULL)
        $konsultasi = Konsultasi::with('pasien')
            ->whereHas('detail_konsultasi', function($query) {
                $query->whereNotNull('id_konsultasi');
            })
            ->get();
        
        $gejala = Gejala::all();
        $riwayat = DetailKonsultasi::all();
        
        return view('admin.riwayat-konsultasi', compact('konsultasi', 'riwayat', 'gejala'));
    }
    // Rest of methods remain the same...
    public function show($id)
    {
        try {
            $konsultasi = Konsultasi::with('pasien')->findOrFail($id);
            return view('admin.detail-konsultasi', compact('konsultasi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data konsultasi tidak ditemukan');
        }
    }
}