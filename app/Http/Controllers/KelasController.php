<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $kela = new Kelas();
        $jurusan = Jurusan::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        $ruang = Ruang::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('kelas.create', compact('kela', 'jurusan', 'ruang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'ruangan' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Kelas::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
                'jurusan_id' => $request->jurusan,
                'ruang_id' => $request->ruangan,
                'nama' => $request->nama
            ]);
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Kelas $kelas)
    {
        //
    }

    public function edit(Kelas $kela)
    {
        $jurusan = Jurusan::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        $ruang = Ruang::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('kelas.edit', compact('kela', 'jurusan', 'ruang'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'ruangan' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $kela->update([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
                'jurusan_id' => $request->jurusan,
                'ruang_id' => $request->ruangan,
                'nama' => $request->nama
            ]);
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Kelas $kela)
    {
        try {
            DB::beginTransaction();
            $kela->delete();
            DB::commit();

            return back()->with('success', 'Kelas berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
