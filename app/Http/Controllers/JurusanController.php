<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Sekolah;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JurusanController extends Controller
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
        $jurusan = [];
        $sekolah = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
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
        $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();

        return view('jurusan.create', compact('jurusan', 'sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'sekolah' => auth()->user()->hasAnyRole('Administrator', 'Admin Yayasan') ? 'required' : ''
        ]);

        try {
            DB::beginTransaction();

            Jurusan::create([
                'sekolah_id' => auth()->user()->staff->sekolah_id ?? $request->sekolah,
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
        $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();

        return view('jurusan.edit', compact('jurusan', 'sekolah'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama' => 'required',
            'sekolah' => auth()->user()->hasAnyRole('Administrator', 'Admin Yayasan') ? 'required' : ''
        ]);

        try {
            DB::beginTransaction();

            $jurusan->update([
                'sekolah_id' => auth()->user()->staff->sekolah_id ?? $request->sekolah,
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
            DB::beginTransaction();
            $jurusan->delete();
            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
