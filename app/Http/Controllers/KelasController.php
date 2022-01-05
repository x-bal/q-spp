<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Kewajiban;
use App\Models\Ruang;
use App\Models\Sekolah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = [];
        $sekolah = [];

        if (auth()->user()->hasRole('Admin Yayasan')) {
            $sekolah = Sekolah::where('yayasan_id', auth()->user()->yayasan->id)->get();
            if (request('sekolah')) {
                $kelas = Kelas::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $kelas = Kelas::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        }

        return view('kelas.index', compact('kelas', 'sekolah'));
    }

    public function create()
    {
        $kela = new Kelas();
        $jurusan = Jurusan::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        $ruang = Ruang::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        $tahun = TahunAjaran::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('kelas.create', compact('kela', 'jurusan', 'ruang', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'ruangan' => 'required',
            'tahun' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Kelas::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
                'jurusan_id' => $request->jurusan,
                'tahun_ajaran_id' => $request->tahun,
                'ruang_id' => $request->ruangan,
                'nama' => $request->nama,
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
        $tahun = TahunAjaran::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('kelas.edit', compact('kela', 'jurusan', 'ruang', 'tahun'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'ruangan' => 'required',
            'tahun' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $kela->update([
                // 'sekolah_id' => auth()->user()->staff->sekolah_id,
                'jurusan_id' => $request->jurusan,
                'tahun_ajaran_id' => $request->tahun,
                'ruang_id' => $request->ruangan,
                'nama' => $request->nama
            ]);
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function kewajiban(Kelas $kela)
    {
        $kewajiban = Kewajiban::where('tahun_ajaran_id', $kela->tahun_ajaran_id)->get();

        return view('kelas.kewajiban', compact('kela', 'kewajiban'));
    }

    public function storeKewajiban(Kelas $kela, Request $request)
    {
        $request->validate(['kewajiban' => 'required']);

        try {
            DB::beginTransaction();
            $kela->kewajiban()->sync($request->kewajiban);
            foreach ($kela->siswa as $siswa) {
                $siswa->kewajiban()->sync($request->kewajiban);
            }
            DB::commit();

            return redirect()->route('tahun-ajaran.show', $kela->tahun_ajaran_id)->with('success', 'Kewajiban Kelas berhasil ditambahkan');
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
