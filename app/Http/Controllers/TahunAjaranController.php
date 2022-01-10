<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\TahunAjaran;
use App\Models\Yayasan;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    public function getSekolah()
    {
        if (auth()->user()->hasRole('Admin Yayasan')) {
            return auth()->user()->yayasan->id;
        }

        if (auth()->user()->hasRole('Administrator')) {
            return Yayasan::where('is_use', 1)->first()->id;
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            return auth()->user()->staff->sekolah_id;
        }
    }

    public function index()
    {
        $sekolah = [];
        $tahun = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getSekolah())->get();
            if (request('sekolah')) {
                $tahun = TahunAjaran::where('sekolah_id', request('sekolah'))->get();
            }
        }
        if (auth()->user()->hasRole('Admin Sekolah')) {
            $tahun = TahunAjaran::where('sekolah_id', $this->getSekolah())->get();
        }

        return view('tahun-ajaran.index', compact('tahun', 'sekolah'));
    }

    public function create()
    {
        $tahunAjaran = new TahunAjaran();
        $sekolah = [];
        if (auth()->user()->hasRole('Admin Yayasan')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getSekolah())->get();
            if (request('sekolah')) {
                $tahun = TahunAjaran::where('sekolah_id', request('sekolah'))->get();
            }
        }

        return view('tahun-ajaran.create', compact('tahunAjaran', 'sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'mulai' => 'required',
            'sampai' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $tahunAjaran = TahunAjaran::create([
                'tahun_ajaran' => $request->tahun,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
                'sekolah_id' => $this->getSekolah()
            ]);

            $tahun = explode('/', $request->tahun);

            $result = CarbonPeriod::create($tahun[0] . '-' . $request->mulai . '-01', '1 month', $tahun[1] . '-' . $request->sampai . '-01');

            foreach ($result as $dt) {
                $tahunAjaran->spp()->create([
                    'sekolah_id' => $this->getSekolah(),
                    'bulan' => $dt->format('F'),
                    'tahun' => $dt->format('Y'),
                ]);
            }

            DB::commit();

            return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.show', compact('tahunAjaran'));
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'tahun' => 'required',
            'mulai' => 'required',
            'sampai' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $tahunAjaran->update([
                'tahun_ajaran' => $request->tahun,
                'mulai' => $request->mulai,
                'sampai' => $request->sampai,
            ]);

            $tahun = explode('/', $request->tahun);

            $result = CarbonPeriod::create($tahun[0] . '-' . $request->mulai . '-01', '1 month', $tahun[1] . '-' . $request->sampai . '-01');

            foreach ($result as $dt => $key) {
                $tahunAjaran->spp[$dt]->update([
                    'sekolah_id' => $this->getSekolah(),
                    'bulan' => $key->format('F'),
                    'tahun' => $key->format('Y'),
                ]);
            }

            DB::commit();

            return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        try {
            DB::beginTransaction();
            $tahunAjaran->delete();
            DB::commit();

            return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun Ajaran berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
