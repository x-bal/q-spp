<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Symfony\Component\String\b;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->get();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role();
        $permissions = Permission::get();

        return view('role.create', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permission);

            return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        return view('role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permission);

            return redirect()->route('role.index')->with('success', 'Role berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return redirect()->route('role.index')->with('success', 'Role berhasil didelete');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
