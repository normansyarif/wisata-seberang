<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::with('permissions')->get();
        return view('role.index', compact('roles'));
    }

    public function permissions($id) {
        $role = Role::where('id', decrypt($id))->with('permissions')->first();
        $permissions = Permission::get();
        if(!$role) abort(404);
        return view('role.permissions', compact('role', 'permissions'));
    }

    public function permissionsSync(Request $request, $id) {
        $role = Role::findOrFail(decrypt($id));
        $role->syncPermissions($request->permissions);
        toastr()->success('Berhasil menyimpan data');
        return back();
    }

    public function destroy($id) {
        $role = Role::findOrFail(decrypt($id));
        try {
            $role->delete();
            toastr()->success('Berhasil menghapus role');
        } catch (\Throwable $th) {
            toastr()->error('Gagal menghapus role');
        }
        return back();
    }

    public function store(Request $request) {
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->guard_name = 'web';
        try {
            $role->save();
            toastr()->success('Berhasil menyimpan data');
        } catch (\Throwable $th) {
            toastr()->error('Gagal menyimpan data');
        }
        return back();
    }
}
