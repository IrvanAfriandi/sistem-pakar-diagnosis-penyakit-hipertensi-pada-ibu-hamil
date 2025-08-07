<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Tampilkan form biodata
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('pasien.biodata-form');
    }

    // Simpan data biodata pasien
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'usia' => 'required|integer|min:1|max:100',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
        ]);

        // Simpan data pasien dan ambil ID-nya
        $pasien = Pasien::create($request->all());
        return redirect()->route('diagnosis.create', ['id_pasien' => $pasien->id_pasien])
                        ->with('success', 'Data biodata berhasil disimpan.');

    }

    // Fungsi lain (index, show, edit, update, destroy) bisa ditambahkan sesuai kebutuhan
}


