<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SppController extends Controller
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
        $siswa = [];
        $spp = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $spp = Spp::where('sekolah_id', request('sekolah'))->get();
                $siswa = Siswa::where('sekolah_id', request('sekolah'))->get();
            }

            if (request('siswa')) {
                $spp = Siswa::findOrFail(request('siswa'));
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $siswa = Siswa::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
            if (request('siswa')) {
                $spp = Siswa::findOrFail(request('siswa'));
            }
        }

        return view('spp.index', compact('spp', 'sekolah', 'siswa'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $siswa = Siswa::find($request->siswa);
        // $siswa->spp()->sync();
    }

    public function show(Spp $spp)
    {
        //
    }

    public function edit(Spp $spp)
    {
        $spp = DB::table('siswa_spp')->where('siswa_id', request('siswa'))->where('spp_id', $spp->id)->first();

        return view('spp.edit', compact('spp'));
    }

    public function update(Request $request, Spp $spp)
    {
        $request->validate([
            'nominal' => 'required',
            'tanggal_bayar' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $siswa = Siswa::findOrFail($request->siswa);
            $siswa->spp()->detach($spp->id);
            $siswa->spp()->attach($spp->id, ['nominal' => $request->nominal, 'tanggal_bayar' => $request->tanggal_bayar, 'status' => $request->status]);
            DB::commit();

            return redirect('spp?siswa=' . $request->siswa)->with('success', 'Pembayaran Spp berhasil dilakukan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function tagihan()
    {
        $sekolah = [];
        $siswa = [];
        $spp = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $spp = Spp::where('sekolah_id', request('sekolah'))->get();
            }

            if (request('siswa')) {
                $siswa = Siswa::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $siswa = Siswa::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
            if (request('siswa')) {
                $spp = Siswa::findOrFail(request('siswa'));
            }
        }

        return view('spp.tagihan', compact('spp', 'sekolah', 'siswa'));
    }

    public function destroy(Spp $spp)
    {
        //
    }
}
