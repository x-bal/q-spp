<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = [];
        $sekolah = [];

        if (auth()->user()->hasRole('Admin Yayasan')) {
            $sekolah = Sekolah::where('yayasan_id', auth()->user()->yayasan->id)->get();
            if (request('sekolah')) {
                $siswa = Siswa::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $siswa = Siswa::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        }

        return view('siswa.index', compact('siswa', 'sekolah'));
    }

    public function create()
    {
        $kelas = Kelas::where('sekolah_id', auth()->user()->staff->sekolah->id)->get();
        $siswa = new Siswa();

        return view('siswa.create', compact('kelas', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Siswa::create([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelas_id' => $request->kelas,
                'sekolah_id' => auth()->user()->staff->sekolah_id,
            ]);
            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Siswa $siswa)
    {
        //
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::where('sekolah_id', auth()->user()->staff->sekolah->id)->get();

        return view('siswa.edit', compact('kelas', 'siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $siswa->update([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelas_id' => $request->kelas,
                // 'sekolah_id' => auth()->user()->staff->sekolah_id,
            ]);
            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Siswa $siswa)
    {
        try {
            DB::beginTransaction();
            $siswa->delete();
            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
