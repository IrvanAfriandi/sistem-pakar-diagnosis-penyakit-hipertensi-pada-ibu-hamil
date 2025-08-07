<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DataPasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('admin.data-pasien', compact('pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'usia' => 'required|integer|min:1|max:100',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
        ]);
        Pasien::create($request->all());
        return redirect()->back()->with('success', 'Pasien berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'usia' => 'required|integer',
            'email' => 'required',
            'alamat' => 'required|string',
        ]);
        $pasien->update($request->all());

        return redirect()->back()->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id) : RedirectResponse
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return redirect()->back()->with('success', 'Pasien berhasil dihapus.');
    }
}
