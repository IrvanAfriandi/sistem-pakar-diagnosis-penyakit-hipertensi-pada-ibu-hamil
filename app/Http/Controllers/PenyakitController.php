<?php
namespace App\Http\Controllers;

use App\Models\Penyakit;
use App\Models\Pengetahuan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('admin.penyakit', compact('penyakit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penyakit' => 'required',
            'nama_penyakit' => 'required',
            'penjelasan' => 'required',
            'penanganan' => 'required',
        ]);
        Penyakit::create($request->all());
        return redirect()->back()->with('success', 'Penyakit berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $Penyakit = Penyakit::findOrFail($id);
        $request->validate([
            'kode_penyakit' => 'required',
            'nama_penyakit' => 'required',
            'penjelasan' => 'required',
            'penanganan' => 'required',
        ]);
        $Penyakit->update($request->all());

        return redirect()->back()->with('success', 'Data Penyakit berhasil diperbarui.');
    }

    public function destroy($id) : RedirectResponse
    {
        Pengetahuan::where('id_penyakit', $id)->update(['id_penyakit' => null]);
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();
        return redirect()->back()->with('success', 'Penyakit berhasil dihapus dan relasinya diubah.');
    }
}
