<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request) {

        if ($request->ajax()) {

            $data = User::orderBy('name');

            return DataTables::of($data)
                ->addColumn('name',function($q){
                    return $q->name;
                })
                ->addColumn('role',function($q){
                    $roles = $q->roles->pluck('display_name');
                    $view = '';

                    foreach($roles as $r) {
                        $view .= '<div class="badge badge-info">' . $r . '</div><br>';
                    }

                    return $view;
                })
                ->addColumn('action', function($q) {
                    return view('user.actions.index', compact(['q']));
                })
                ->escapeColumns('action')
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.index');
    }

    public function role($id) {
        $user = User::findOrFail(decrypt($id));
        $roles = Role::with('permissions')->get();
        return view('user.role', compact('roles', 'user'));
    }

    public function roleSync(Request $request, $id) {
        $user = User::findOrFail(decrypt($id));
        $user->roles()->sync($request->roles);
        toastr()->success('Berhasil menyimpan data');
        return back();
    }

    public function store(Request $request) {
        if($request->password != $request->konfirmasi) {
            toastr()->error('password tidak cocok');
            return back();
        }

        $user = User::where('email', $request->email)->count();
        if($user > 0) {
            toastr()->error('email telah digunakan');
            return back();
        }

        $data = new User();
        $data->username = $request->email;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
        $data->save();
        toastr()->success('Berhasil');
        return back();
    }
}
