<?php

namespace App\Http\Controllers;

use App\Models\Kewajiban;
use App\Models\Sekolah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KewajibanController extends Controller
{
    public function getSekolah()
    {
        if (auth()->user()->hasRole('Admin Yayasan')) {
            return auth()->user()->yayasan->id;
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            return auth()->user()->staff->sekolah_id;
        }
    }

    public function index()
    {
        $sekolah = [];

        if (auth()->user()->hasRole('Admin Yayasan')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getSekolah())->get();
            if (request('sekolah')) {
                $kewajiban = Kewajiban::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $kewajiban = Kewajiban::where('sekolah_id', $this->getSekolah())->get();
        }

        return view('kewajiban.index', compact('kewajiban', 'sekolah'));
    }

    public function create()
    {
        $kewajiban = new Kewajiban();
        $tahun = TahunAjaran::where('sekolah_id', $this->getSekolah())->get();

        return view('kewajiban.create', compact('kewajiban', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'biaya' => 'required',
            'tahun' => 'required',
            'jatuh_tempo' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Kewajiban::create([
                'nama' => $request->nama,
                'biaya' => $request->biaya,
                'jatuh_tempo' => $request->jatuh_tempo,
                'tahun_ajaran_id' => $request->tahun,
                'sekolah_id' => $this->getSekolah()
            ]);
            DB::commit();

            return redirect()->route('kewajiban.index')->with('success', 'Kewajiban berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Kewajiban $kewajiban)
    {
        //
    }

    public function edit(Kewajiban $kewajiban)
    {
        $tahun = TahunAjaran::where('sekolah_id', $this->getSekolah())->get();

        return view('kewajiban.edit', compact('kewajiban', 'tahun'));
    }

    public function update(Request $request, Kewajiban $kewajiban)
    {
        $request->validate([
            'nama' => 'required',
            'biaya' => 'required',
            'tahun' => 'required',
            'jatuh_tempo' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $kewajiban->update([
                'nama' => $request->nama,
                'biaya' => $request->biaya,
                'jatuh_tempo' => $request->jatuh_tempo,
                'tahun_ajaran_id' => $request->tahun,
                // 'sekolah_id' => $this->getSekolah()
            ]);
            DB::commit();

            return redirect()->route('kewajiban.index')->with('success', 'Kewajiban berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Kewajiban $kewajiban)
    {
        try {
            DB::beginTransaction();
            $kewajiban->delete();
            DB::commit();

            return redirect()->route('kewajiban.index')->with('success', 'Kewajiban berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
