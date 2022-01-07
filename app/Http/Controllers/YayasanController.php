<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class YayasanController extends Controller
{
    public function index()
    {
        $yayasan = Yayasan::get();

        return view('yayasan.index', compact('yayasan'));
    }

    public function create()
    {
        $yayasan = new Yayasan();

        return view('yayasan.create', compact('yayasan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'nama_yayasan' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'logo' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $logo = $request->file('logo');
            $logoUrl = $logo->storeAs('yayasan/logo', Str::slug($request->nama_yayasan) . '.' . $logo->extension());

            $user = User::create([
                'name' => $request->nama_pemilik,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            $user->yayasan()->create([
                'nama' => $request->nama_yayasan,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'logo' => $logoUrl,
            ]);
            DB::commit();

            return redirect()->route('yayasan.index')->with('success', 'Yayasan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Yayasan $yayasan)
    {
        //
    }

    public function edit(Yayasan $yayasan)
    {
        return view('yayasan.edit', compact('yayasan'));
    }

    public function update(Request $request, Yayasan $yayasan)
    {
        $request->validate([
            'nama_pemilik' => 'required',
            'username' => 'required|unique:users,username,' . $yayasan->admin->id,
            'email' => 'required|unique:users,email,' . $yayasan->admin->id,
            'nama_yayasan' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        try {
            DB::beginTransaction();
            if ($request->file('logo')) {
                Storage::delete($yayasan->logo);
                $logo = $request->file('logo');
                $logoUrl = $logo->storeAs('yayasan/logo', Str::slug($request->nama_yayasan) . '.' . $logo->extension());
            } else {
                $logoUrl = $yayasan->logo;
            }

            $yayasan->admin()->update([
                'name' => $request->nama_pemilik,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            $yayasan->update([
                'nama' => $request->nama_yayasan,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'logo' => $logoUrl,
            ]);
            DB::commit();

            return redirect()->route('yayasan.index')->with('success', 'Yayasan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function use(Yayasan $yayasan)
    {
        try {
            if (request('use') == 1) {
                DB::beginTransaction();
                foreach (Yayasan::get() as $ysn) {
                    $ysn->update(['is_use' => 0]);
                }

                $yayasan->update([
                    'is_use' => 1
                ]);
                DB::commit();

                return redirect()->route('yayasan.index')->with('success', 'Yayasan berhasil diaktifkan');
            } else {
                DB::beginTransaction();
                foreach (Yayasan::get() as $ysn) {
                    $ysn->update(['is_use' => 0]);
                }

                $yayasan->update(['is_use' => 0]);
                DB::commit();

                return redirect()->route('yayasan.index')->with('success', 'Yayasan berhasil dinonaktifkan');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Yayasan $yayasan)
    {
        //
    }
}
