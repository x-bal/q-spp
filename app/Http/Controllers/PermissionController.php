<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        $permission = new Permission();

        return view('permission.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        try {
            DB::beginTransaction();
            Permission::create(['name' => Str::slug($request->name)]);
            DB::commit();

            return back()->with('success', 'Permission berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate(['name' => 'required']);

        try {
            DB::beginTransaction();
            $permission->update(['name' => Str::slug($request->name)]);
            DB::commit();

            return back()->with('success', 'Permission berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            DB::beginTransaction();
            $permission->delete();
            DB::commit();

            return back()->with('success', 'Permission berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
