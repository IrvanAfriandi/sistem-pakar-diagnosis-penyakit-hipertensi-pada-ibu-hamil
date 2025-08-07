<?php
namespace App\Http\Controllers;

use App\Models\Pengetahuan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PengetahuanController extends Controller
{
    public function index()
    {
        $knowledge = Pengetahuan::with(['penyakit', 'gejala'])->get();
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        return view('admin.basis-pengetahuan', compact('knowledge', 'penyakit', 'gejala'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_penyakit' => 'required|exists:penyakit,id_penyakit',
            'id_gejala' => 'required|exists:gejala,id_gejala',
            'cf_pakar' => 'required|numeric|min:0|max:1',
        ], [
            'id_penyakit.required' => 'Penyakit harus dipilih.',
            'id_penyakit.exists' => 'Penyakit yang dipilih tidak valid.',
            'id_gejala.required' => 'Gejala harus dipilih.',
            'id_gejala.exists' => 'Gejala yang dipilih tidak valid.',
            'cf_pakar.required' => 'CF Pakar harus diisi.',
            'cf_pakar.numeric' => 'CF Pakar harus berupa angka.',
            'cf_pakar.min' => 'CF Pakar minimal 0.',
            'cf_pakar.max' => 'CF Pakar maksimal 1.',
        ]);
        $existingKnowledge = Pengetahuan::where('id_penyakit', $request->id_penyakit)
                                              ->where('id_gejala', $request->id_gejala)
                                              ->first();
        if ($existingKnowledge) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Kombinasi penyakit dan gejala sudah ada dalam basis pengetahuan.');
        }
        try {
            Pengetahuan::create([
                'id_penyakit' => $request->id_penyakit,
                'id_gejala' => $request->id_gejala,
                'cf_pakar' => $request->cf_pakar,
            ]);
            return redirect()->back()->with('success', 'Aturan basis pengetahuan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $pengetahuan = Pengetahuan::findOrFail($id);
        
        $request->validate([
            'id_penyakit' => 'required|exists:penyakit,id_penyakit',
            'id_gejala' => 'required|exists:gejala,id_gejala',
            'cf_pakar' => 'required|numeric|min:0|max:1',
        ], [
            'id_penyakit.required' => 'Penyakit harus dipilih.',
            'id_penyakit.exists' => 'Penyakit yang dipilih tidak valid.',
            'id_gejala.required' => 'Gejala harus dipilih.',
            'id_gejala.exists' => 'Gejala yang dipilih tidak valid.',
            'cf_pakar.required' => 'CF Pakar harus diisi.',
            'cf_pakar.numeric' => 'CF Pakar harus berupa angka.',
            'cf_pakar.min' => 'CF Pakar minimal 0.',
            'cf_pakar.max' => 'CF Pakar maksimal 1.',
        ]);
        $existingKnowledge = Pengetahuan::where('id_penyakit', $request->id_penyakit)
                                              ->where('id_gejala', $request->id_gejala)
                                              ->where('id_pengetahuan', '!=', $id)
                                              ->first();
        if ($existingKnowledge) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Kombinasi penyakit dan gejala sudah ada dalam basis pengetahuan.');
        }
        try {
            $pengetahuan->update([
                'id_penyakit' => $request->id_penyakit,
                'id_gejala' => $request->id_gejala,
                'cf_pakar' => $request->cf_pakar,
            ]);
            return redirect()->back()->with('success', 'Aturan basis pengetahuan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
    public function destroy($id): RedirectResponse
    {
        try {
            $pengetahuan = Pengetahuan::findOrFail($id);
            $penyakitNama = $pengetahuan->penyakit->nama_penyakit ?? 'Unknown';
            $gejalaNama = $pengetahuan->gejala->nama_gejala ?? 'Unknown';
            $pengetahuan->delete();
            return redirect()->back()->with('success', "Aturan basis pengetahuan untuk '{$penyakitNama} - {$gejalaNama}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}