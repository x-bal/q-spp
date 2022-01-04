<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = [];
        $sekolah = [];

        if (auth()->user()->hasRole('Admin Yayasan')) {
            $sekolah = Sekolah::where('yayasan_id', auth()->user()->yayasan->id)->get();
            if (request('sekolah')) {
                $jurusan = Jurusan::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $jurusan = Jurusan::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        }

        return view('jurusan.index', compact('jurusan', 'sekolah'));
    }

    public function create()
    {
        $jurusan = new Jurusan();

        return view('jurusan.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            Jurusan::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id,
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
            ]);

            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Jurusan $jurusan)
    {
        //
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate(['nama' => 'required']);

        try {
            DB::beginTransaction();

            $jurusan->update([
                // 'sekolah_id' => auth()->user()->staff->sekolah_id,
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
            ]);

            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Jurusan $jurusan)
    {
        try {
            $jurusan->delete();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
