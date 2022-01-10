<?php

namespace App\Http\Controllers;

use App\Models\Kewajiban;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KewajibanController extends Controller
{
    public function getId()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return Yayasan::where('is_use', 1)->first()->id;
        }

        if (auth()->user()->hasRole('Admin Yayasan')) {
            return auth()->user()->yayasan->id;
        }
    }

    public function index()
    {
        $sekolah = [];
        $kewajiban = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $kewajiban = Kewajiban::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $kewajiban = Kewajiban::where('sekolah_id', $this->getId())->get();
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

    public function pembayaran()
    {
        $sekolah = [];
        $siswa = [];
        $siswas = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $sekolah = Sekolah::where('yayasan_id', request('sekolah'))->get();
                $siswas = Siswa::where('sekolah_id', request('sekolah'))->get();
            }

            if (request('siswa')) {
                $siswa = Siswa::findOrFail(request('siswa'));
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $siswas = Siswa::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
            if (request('siswa')) {
                $siswa = Siswa::findOrFail(request('siswa'));
            }
        }

        return view('kewajiban.pembayaran', compact('siswa', 'sekolah', 'siswas'));
    }

    public function bayar(Kewajiban $kewajiban)
    {
        $kewajiban = DB::table('kewajiban_siswa')->where('siswa_id', request('siswa'))->where('kewajiban_id', $kewajiban->id)->first();

        return view('kewajiban.bayar', compact('kewajiban'));
    }

    public function bayarKewajiban(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'tanggal_bayar' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $kewajiban = Kewajiban::find($request->kewajiban);
            $kewajiban->siswa()->detach($request->siswa);
            $kewajiban->siswa()->attach($request->siswa, ['tgl_bayar' => $request->tanggal_bayar, 'nominal' => $request->nominal, 'status' => $request->status]);
            DB::commit();

            return redirect('/kewajiban/pembayaran?siswa=' . $request->siswa)->with('success', 'Pembayaran berhasil');
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
