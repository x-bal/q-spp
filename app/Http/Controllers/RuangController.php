<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();

        return view('ruang.index', compact('ruangs'));
    }

    public function create()
    {
        $ruang = new Ruang();

        return view('ruang.create', compact('ruang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Ruang::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
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
        return view('ruang.edit', compact('ruang'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $ruang->update([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
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
