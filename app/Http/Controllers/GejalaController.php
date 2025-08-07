<?php
namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class GejalaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::all();
        return view('admin.gejala', compact('gejala'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required',
            'nama_gejala' => 'required',
        ]);
        Gejala::create($request->all());
        return redirect()->back()->with('success', 'gejala berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $gejala = Gejala::findOrFail($id);
        $request->validate([
            'kode_gejala' => 'required',
            'nama_gejala' => 'required',
        ]);
        $gejala->update($request->all());

        return redirect()->back()->with('success', 'Data Gejala berhasil diperbarui.');
    }

    public function destroy($id) : RedirectResponse
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();
        return redirect()->back()->with('success', 'Gejala berhasil dihapus.');
    }
}
