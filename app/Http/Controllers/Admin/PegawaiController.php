<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(10);
        return view('admin.pegawai.index-pegawai-admin', compact('pegawai'));
    }

    public function viewTambahPegawai()
    {
        return view('admin.pegawai.tambah-pegawai-admin');
    }

    public function storeTambahPegawai(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'pendidikan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        Pegawai::create($validatedData);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    public function viewEditPegawai($id_pegawai)
    {
        $pegawai = Pegawai::findOrFail($id_pegawai);
        return view('admin.pegawai.edit-pegawai-admin', compact('pegawai'));
    }

    public function storeEditPegawai(Request $request, $id_pegawai)
    {
        $pegawai = Pegawai::findOrFail($id_pegawai);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'pendidikan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $pegawai->update($validatedData);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function storeHapusPegawai($id_pegawai)
    {
        $pegawai = Pegawai::findOrFail($id_pegawai);
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
