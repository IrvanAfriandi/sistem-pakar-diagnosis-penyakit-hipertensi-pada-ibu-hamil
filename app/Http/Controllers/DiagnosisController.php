<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Konsultasi;
use App\Models\Gejala;
use App\Models\Pengetahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailKonsultasi;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $gejala = Gejala::orderBy('kode_gejala')->get();
        $id_konsultasi = $request->query('id_konsultasi');
        return view('pasien.diagnosis', compact('id_konsultasi', 'gejala'));
    }
    public function show(Request $request, $id)
    {
        try {
            Log::info("=== DIAGNOSIS SHOW START ===");
            Log::info("Request ID: " . $id);
            Log::info("Step 1: Loading consultation data...");
            $konsultasi = Konsultasi::with([
                'pasien', 
                'detail_konsultasi'
            ])->find($id);

            if (!$konsultasi) {
                Log::error("Konsultasi dengan ID {$id} tidak ditemukan");
                return redirect()->back()->with('error', 'Konsultasi tidak ditemukan.');
            }
            Log::info("Konsultasi loaded:", [
                'id_konsultasi' => $konsultasi->id_konsultasi,
                'pasien_nama' => $konsultasi->pasien ? $konsultasi->pasien->nama : 'NULL',
                'detail_count' => $konsultasi->detail_konsultasi ? $konsultasi->detail_konsultasi->count() : 0
            ]);
            if (!$konsultasi->detail_konsultasi || $konsultasi->detail_konsultasi->isEmpty()) {
                Log::warning("Detail konsultasi kosong untuk ID: " . $id);
                return redirect()->back()->with('error', 'Data konsultasi tidak lengkap. Silakan lakukan konsultasi ulang.');
            }
            Log::info("Step 3: Loading diseases...");
            $penyakit = Penyakit::orderBy('kode_penyakit')->get();
            Log::info("Diseases loaded: " . $penyakit->count());

            if ($penyakit->isEmpty()) {
                Log::error("Tidak ada data penyakit di database");
                return redirect()->back()->with('error', 'Data penyakit tidak tersedia.');
            }
            Log::info("Step 4: Loading symptoms...");
            $gejala = Gejala::orderBy('kode_gejala')->get();
            Log::info("Symptoms loaded: " . $gejala->count());

            if ($gejala->isEmpty()) {
                Log::error("Tidak ada data gejala di database");
                return redirect()->back()->with('error', 'Data gejala tidak tersedia.');
            }
            Log::info("Step 5: Loading knowledge base...");
            $basisPengetahuan = DB::table('basis_pengetahuan as bp')
                ->join('penyakit as p', 'bp.id_penyakit', '=', 'p.id_penyakit')
                ->join('gejala as g', 'bp.id_gejala', '=', 'g.id_gejala')
                ->select(
                    'bp.id_pengetahuan',
                    'bp.id_penyakit',
                    'bp.id_gejala',
                    'p.kode_penyakit',
                    'p.nama_penyakit',
                    'g.kode_gejala',
                    'g.nama_gejala',
                    'bp.cf_pakar'
                )
                ->orderBy('p.kode_penyakit')
                ->orderBy('g.kode_gejala')
                ->get();

            Log::info("Knowledge base loaded: " . $basisPengetahuan->count());

            if ($basisPengetahuan->isEmpty()) {
                Log::error("Tidak ada data basis pengetahuan di database");
                return redirect()->back()->with('error', 'Data basis pengetahuan tidak tersedia.');
            }
            Log::info("=== SAMPLE DATA DEBUG ===");
            Log::info("Sample Penyakit:", $penyakit->take(2)->toArray());
            Log::info("Sample Gejala:", $gejala->take(2)->toArray());
            Log::info("Sample Basis Pengetahuan:", $basisPengetahuan->take(2)->toArray());
            Log::info("Detail Konsultasi:", $konsultasi->detail_konsultasi->toArray());
            $dataComplete = [
                'konsultasi' => $konsultasi ? 'OK' : 'NULL',
                'pasien' => $konsultasi->pasien ? 'OK' : 'NULL',
                'detail_konsultasi' => $konsultasi->detail_konsultasi->count() > 0 ? 'OK' : 'EMPTY',
                'penyakit' => $penyakit->count() > 0 ? 'OK' : 'EMPTY',
                'gejala' => $gejala->count() > 0 ? 'OK' : 'EMPTY',
                'basis_pengetahuan' => $basisPengetahuan->count() > 0 ? 'OK' : 'EMPTY'
            ];
            Log::info("Data validation:", $dataComplete);
            Log::info("=== DIAGNOSIS SHOW SUCCESS ===");

            return view('pasien.hasil-konsultasi', compact(
                'konsultasi', 
                'gejala',
                'penyakit',
                'basisPengetahuan'
            ));

        } catch (\Exception $e) {
            Log::error("=== DIAGNOSIS SHOW ERROR ===");
            Log::error('Error message: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan hasil diagnosis: ' . $e->getMessage());
        }
    }
    public function create(Request $request)
    {
        try {
            $id_pasien = $request->query('id_pasien');
            
            if (!$id_pasien) {
                return redirect()->back()->with('error', 'ID Pasien tidak ditemukan.');
            }
            $pasien = Pasien::findOrFail($id_pasien);

            $konsultasi = Konsultasi::create([
                'id_pasien' => $id_pasien,
            ]);

            return redirect()->route('diagnosis.index', ['id_konsultasi' => $konsultasi->id_konsultasi]);

        } catch (\Exception $e) {
            Log::error('Error creating consultation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat konsultasi baru.');
        }
    }
    public function store(Request $request)
    {
        try {
            Log::info("=== DIAGNOSIS STORE START ===");
            Log::info("Request data:", $request->all());

            $request->validate([
                'id_konsultasi' => 'required|integer|exists:konsultasi,id_konsultasi',
                'gejala' => 'required|array|min:1',
            ]);

            $idKonsultasi = $request->id_konsultasi;
            $gejalaData = $request->gejala;
            Log::info("Processing konsultasi ID: " . $idKonsultasi);
            Log::info("Gejala data count: " . count($gejalaData));
            $konsultasi = Konsultasi::with('pasien')->findOrFail($idKonsultasi);
            Log::info("Konsultasi found:", [
                'id' => $konsultasi->id_konsultasi,
                'pasien' => $konsultasi->pasien->nama
            ]);
            $deletedCount = DetailKonsultasi::where('id_konsultasi', $idKonsultasi)->count();
            DetailKonsultasi::where('id_konsultasi', $idKonsultasi)->delete();
            Log::info("Deleted old detail konsultasi: " . $deletedCount . " records");

            $detailKonsultasiData = [];

            foreach ($gejalaData as $index => $gejalaJson) {
                Log::info("Processing gejala #{$index}: " . $gejalaJson);
                
                $gejala = json_decode($gejalaJson, true);
                
                if ($gejala && isset($gejala['id_gejala']) && isset($gejala['cf_pasien'])) {
                    if (Gejala::where('id_gejala', $gejala['id_gejala'])->exists()) {
                        $detailKonsultasiData[] = [
                            'id_konsultasi' => $idKonsultasi,
                            'id_gejala' => $gejala['id_gejala'],
                            'cf_pasien' => floatval($gejala['cf_pasien'])
                        ];
                        Log::info("Added gejala ID {$gejala['id_gejala']} with CF {$gejala['cf_pasien']}");
                    } else {
                        Log::warning("Gejala ID {$gejala['id_gejala']} tidak ditemukan di database");
                    }
                } else {
                    Log::warning("Invalid gejala data: " . $gejalaJson);
                }
            }

            Log::info("Total valid detail konsultasi: " . count($detailKonsultasiData));

            if (!empty($detailKonsultasiData)) {
                $insertedCount = DetailKonsultasi::insert($detailKonsultasiData);
                Log::info("Inserted detail konsultasi records");
                
                Log::info('Diagnosis data stored successfully:', [
                    'konsultasi_id' => $idKonsultasi,
                    'pasien' => $konsultasi->pasien->nama,
                    'total_gejala' => count($detailKonsultasiData)
                ]);
                
                $redirectUrl = route('diagnosis.show', $idKonsultasi);
                Log::info("Redirect URL: " . $redirectUrl);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data diagnosis berhasil disimpan',
                    'data' => [
                        'id_konsultasi' => $idKonsultasi,
                        'total_gejala' => count($detailKonsultasiData)
                    ],
                    'redirect_url' => $redirectUrl
                ]);
            }

            Log::error("No valid detail konsultasi data to insert");
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data gejala yang valid untuk disimpan'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Validation error:", $e->validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);

        } catch (\Exception $e) {
            Log::error('=== DIAGNOSIS STORE ERROR ===');
            Log::error('Error message: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            Log::error('Request data: ' . json_encode($request->all()));
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function saveDiagnosisResult(Request $request)
    {
        try {
            $request->validate([
                'id_konsultasi' => 'required|exists:konsultasi,id_konsultasi',
                'hasil_diagnosa' => 'required|string|max:100',
                'tingkat_keyakinan' => 'required|numeric|between:0,1'
            ]);

            $konsultasi = Konsultasi::findOrFail($request->id_konsultasi);
            $konsultasi->tanggal = now();
            $konsultasi->hasil_diagnosa = $request->hasil_diagnosa;
            $konsultasi->tingkat_keyakinan = $request->tingkat_keyakinan;
            $konsultasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Hasil diagnosis berhasil disimpan',
                'data' => [
                    'id_konsultasi' => $konsultasi->id_konsultasi,
                    'hasil_diagnosa' => $konsultasi->hasil_diagnosa,
                    'tingkat_keyakinan' => $konsultasi->tingkat_keyakinan
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan hasil diagnosis: ' . $e->getMessage()
            ], 500);
        }
    }
}