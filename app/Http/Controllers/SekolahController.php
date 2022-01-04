<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::where('yayasan_id', auth()->user()->yayasan->id)->get();

        return view('sekolah.index', compact('sekolah'));
    }

    public function create()
    {
        $sekolah = new Sekolah();

        return view('sekolah.create', compact('sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'logo' => 'mimes:png, svg, jpg, jpeg, gif'
        ]);

        try {
            if ($request->file('logo')) {
                $logo = $request->file('logo');
                $logoUrl = $logo->storeAs('sekolah/logo', Str::slug($request->nama) . '.' . $logo->extension());
            } else {
                $logoUrl = '';
            }


            DB::beginTransaction();

            Sekolah::create([
                'yayasan_id'  => auth()->user()->yayasan->id,
                'nama' => $request->nama,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'logo' => $logoUrl,
            ]);

            DB::commit();

            return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Sekolah $sekolah)
    {
        //
    }

    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'logo' => 'mimes:png, svg, jpg, jpeg, gif'
        ]);

        try {
            if ($request->file('logo')) {
                Storage::delete($sekolah->logo);
                $logo = $request->file('logo');
                $logoUrl = $logo->storeAs('sekolah/logo', Str::slug($request->nama) . '.' . $logo->extension());
            } else {
                $logoUrl = $sekolah->logo;
            }


            DB::beginTransaction();

            $sekolah->update([
                'yayasan_id'  => auth()->user()->yayasan->id,
                'nama' => $request->nama,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'logo' => $logoUrl,
            ]);

            DB::commit();

            return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Sekolah $sekolah)
    {
        try {
            Storage::delete($sekolah->logo);
            $sekolah->delete();

            return back()->with('success', 'Sekolah berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
