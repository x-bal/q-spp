<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuangController extends Controller
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
        $ruangs = [];
        $sekolah = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $ruangs = Ruang::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $ruangs = Ruang::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        }

        return view('ruang.index', compact('ruangs', 'sekolah'));
    }

    public function create()
    {
        $ruang = new Ruang();
        $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();

        return view('ruang.create', compact('ruang', 'sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sekolah' => auth()->user()->hasRole('Admin Sekolah') ? '' : 'required',
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Ruang::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id ?? $request->sekolah,
                'nama' => $request->nama,
                'lantai' => $request->lantai,
                'gedung' => $request->gedung,
            ]);

            DB::commit();

            return redirect()->route('ruang.index')->with('success', 'Ruangan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Ruang $ruang)
    {
        //
    }

    public function edit(Ruang $ruang)
    {
        $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();

        return view('ruang.edit', compact('ruang', 'sekolah'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'sekolah' => auth()->user()->hasRole('Admin Sekolah') ? '' : 'required',
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $ruang->update([
                'sekolah_id' => auth()->user()->staff->sekolah_id ?? $request->sekolah,
                'nama' => $request->nama,
                'lantai' => $request->lantai,
                'gedung' => $request->gedung,
            ]);

            DB::commit();

            return redirect()->route('ruang.index')->with('success', 'Ruangan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Ruang $ruang)
    {
        try {
            DB::beginTransaction();
            $ruang->delete();
            DB::commit();

            return redirect()->route('ruang.index')->with('success', 'Ruangan berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
