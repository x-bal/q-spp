<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Staff;
use App\Models\User;
use App\Models\Yayasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
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
        $staffs = [];
        $sekolah = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
            if (request('sekolah')) {
                $staffs = Staff::where('sekolah_id', request('sekolah'))->get();
            }
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $staffs = Staff::where('sekolah_id', auth()->user()->staff->sekolah_id)->get();
        }

        return view('staff.index', compact('staffs', 'sekolah'));
    }

    public function create()
    {
        $staff = new Staff();
        $sekolah = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
        }

        return view('staff.create', compact('staff', 'sekolah'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasRole('Admin Yayasan')) {
            $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'jabatan' => 'required',
                'tanggal_lahir' => 'required',
                'sekolah' => 'required',
            ], [
                'username.required' => 'The nip field is required.',
                'username.unique' => 'The nip has already been taken.',
            ]);
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'jabatan' => 'required',
                'tanggal_lahir' => 'required',
            ], [
                'username.required' => 'The nip field is required.',
                'username.unique' => 'The nip has already been taken.',
            ]);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->username,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make(Carbon::parse($request->tanggal_lahir)->format('dmY')),
            ]);

            $user->staff()->create([
                'sekolah_id' => auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator') ? $request->sekolah : auth()->user()->staff->sekolah_id,
                'jabatan' => $request->jabatan,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DB::commit();

            return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Staff $staff)
    {
        //
    }

    public function edit(Staff $staff)
    {
        $sekolah = [];

        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $sekolah = Sekolah::where('yayasan_id', $this->getId())->get();
        }

        return view('staff.edit', compact('staff', 'sekolah'));
    }

    public function update(Request $request, Staff $staff)
    {
        if (auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator')) {
            $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users,username,' . $staff->user->id,
                'email' => 'required|unique:users,email,' . $staff->user->id,
                'jabatan' => 'required',
                'tanggal_lahir' => 'required',
                'sekolah' => 'required',
            ], [
                'username.required' => 'The nip field is required.',
                'username.unique' => 'The nip has already been taken.',
            ]);
        }

        if (auth()->user()->hasRole('Admin Sekolah')) {
            $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users,username,' . $staff->user->id,
                'email' => 'required|unique:users,email,' . $staff->user->id,
                'jabatan' => 'required',
                'tanggal_lahir' => 'required',
            ], [
                'username.required' => 'The nip field is required.',
                'username.unique' => 'The nip has already been taken.',
            ]);
        }

        try {
            DB::beginTransaction();

            $staff->user()->update([
                'username' => $request->username,
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make(Carbon::parse($request->tanggal_lahir)->format('dmY')),
            ]);

            $staff->update([
                'sekolah_id' => auth()->user()->hasAnyRole('Admin Yayasan', 'Administrator') ? $request->sekolah : auth()->user()->staff->sekolah_id,
                'jabatan' => $request->jabatan,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DB::commit();

            return redirect()->route('staff.index')->with('success', 'Staff berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Staff $staff)
    {
        try {
            DB::beginTransaction();

            $staff->user()->update(['is_active' => 0]);

            DB::commit();
            return back()->with('success', 'Staff berhasil dinonaktifkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function activate(Request $request, Staff $staff)
    {
        try {
            DB::beginTransaction();
            $staff->user()->update(['is_active' => 1]);
            DB::commit();

            return back()->with('success', 'Staff berhasil diaktifkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
