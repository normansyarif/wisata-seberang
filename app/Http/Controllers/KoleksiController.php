<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KoleksiController extends Controller
{
    public function index() {
        $koleksi = Koleksi::orderBy('nama_koleksi', 'asc')->get();
        return view('koleksi.index', compact('koleksi'));
    }

    public function create() {
        return view('koleksi.create');
    }

    public function store(Request $request) {
        if($request->hasFile('icon')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('icon')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            $filenameToStore = rand() . time() . '.' . $ext;
            $request->file('icon')->move(public_path('icons'), $filenameToStore);
            
            $koleksi = new Koleksi();
            $koleksi->nama_koleksi = $request->nama_koleksi;
            $koleksi->icon = $filenameToStore;
            $koleksi->save();
            toastr()->success('Berhasil menambah data');
            return redirect(route('koleksi.index'));
        }else{
            toastr()->error('Mohon upload icon terlebih dahulu');
            return back();
        }
    }

    public function edit($id) {
        $koleksi = Koleksi::findOrFail(decrypt($id));
        return view('koleksi.edit', compact('koleksi'));
    }

    public function update(Request $request, $id) {
        $koleksi = Koleksi::findOrFail(decrypt($id));
        $koleksi->nama_koleksi = $request->nama_koleksi;

        if($request->hasFile('icon')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('icon')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            if(file_exists(public_path('icons/' . $koleksi->icon))) {
                File::delete(public_path('icons/' . $koleksi->icon));
            }

            $filenameToStore = rand() . time() . '.' . $ext;
            $request->file('icon')->move(public_path('icons'), $filenameToStore);
            $koleksi->icon = $filenameToStore;
        }

        $koleksi->save();
        toastr()->success('Berhasil mengubah data');
        return back();
    }

    public function destroy($id) {
        $koleksi = Koleksi::findOrFail(decrypt($id));

        try {
            $icon = $koleksi->icon;
            $koleksi->delete();
            
            if(file_exists(public_path('icons/' . $icon))) {
                File::delete(public_path('icons/' . $icon));
            }

            toastr()->success('Berhasil menghapus data');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Gagal menghapus. Pastikan tidak ada konten yang menggunakan jenis koleksi ini');
            return back();
        }
    }
}
