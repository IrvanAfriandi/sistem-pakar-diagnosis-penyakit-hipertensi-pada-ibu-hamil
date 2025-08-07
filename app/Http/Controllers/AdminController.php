<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Pasien;
use App\Models\Konsultasi;
use App\Models\Penyakit;
use App\Models\Gejala;

class AdminController extends Controller
{

public function admin_dashboard()
{
    $pasien = Pasien::count();
    $konsultasi = Konsultasi::count();
    $penyakit = Penyakit::count();
    $gejala = Gejala::count();

    return view('admin.dashboard', compact(
        'pasien',
        'konsultasi',
        'penyakit',
        'gejala'
    ));
}

    public function index()
    {
        $admin = User::all();
        return view('admin.data-admin', compact('admin'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
          'name' => 'required',
          'email' => 'required',
          'password' => 'required',
          'role' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('admin.index')
                         ->with('success','Admin baru berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Data Admin berhasil diperbarui.');
    }
    public function destroy($id) : RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }
}


