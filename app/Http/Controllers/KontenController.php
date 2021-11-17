<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Koleksi;
use App\Models\Konten;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class KontenController extends Controller
{
    public function dashboard() {
        $koleksi = Koleksi::orderBy('nama_koleksi', 'asc')->get();
        return view('konten.dashboard', compact(['koleksi']));
    }
    
    public function index(Request $request) {
        $koleksi = Koleksi::orderBy('nama_koleksi', 'asc')->get();

        if ($request->ajax()) {
            $data = Konten::when($request->id_koleksi, function($q) use($request) {
                $q->where('id_koleksi', $request->id_koleksi);
            });

            return DataTables::of($data)
                ->addColumn('nama',function($q){
                    return $q->nama;
                })
                ->addColumn('gambar',function($q){
                    return '<img style="width: 100%" src="' . url('uploads/gambar/' . $q->gambar) . '" />';
                })
                ->addColumn('koleksi',function($q){
                    return $q->koleksi->nama_koleksi;
                })
                ->addColumn('action', function($q) {
                    return view('konten.actions.index', compact(['q']));
                })
                ->escapeColumns('action')
                ->addIndexColumn()
                ->make(true);
        }

        return view('konten.index', compact('koleksi'));
    }

    public function create() {
        $koleksi = Koleksi::orderBy('nama_koleksi', 'asc')->get();
        return view('konten.create', compact([
            'koleksi'
        ]));
    }

    private function getYoutubeId($url) {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        if(isset($my_array_of_vars['v'])) {
            return $my_array_of_vars['v'];
        }else{
            return null;
        }
    }

    public function store(Request $request) {
        $youtube = null;

        if(!empty($request->video_youtube)) {
            $youtube = $this->getYoutubeId($request->video_youtube);
        
            if($youtube == null) {
                toastr()->error('Link youtube tidak valid');
                return back();
            }
        }
        

        if($request->hasFile('gambar')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('gambar')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            $filenameToStore = rand() . time() . '.' . $ext;
            $request->file('gambar')->move(public_path('uploads/gambar'), $filenameToStore);
            
            $data = new Konten();
            $data->nama = $request->nama;
            $data->id_koleksi = $request->id_koleksi;
            $data->video_youtube = $youtube;
            $data->kontak = $request->kontak;
            $data->lat_long = $request->lat_long;
            $data->narasi = $request->narasi;
            $data->gambar = $filenameToStore;

            try {
                $data->save();

                if(!empty($request->senin_mulai) && !empty($request->senin_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'senin';
                    $jam->mulai = $request->senin_mulai;
                    $jam->berakhir = $request->senin_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->selasa_mulai) && !empty($request->selasa_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'selasa';
                    $jam->mulai = $request->selasa_mulai;
                    $jam->berakhir = $request->selasa_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->rabu_mulai) && !empty($request->rabu_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'rabu';
                    $jam->mulai = $request->rabu_mulai;
                    $jam->berakhir = $request->rabu_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->kamis_mulai) && !empty($request->kamis_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'kamis';
                    $jam->mulai = $request->kamis_mulai;
                    $jam->berakhir = $request->kamis_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->jumat_mulai) && !empty($request->jumat_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'jumat';
                    $jam->mulai = $request->jumat_mulai;
                    $jam->berakhir = $request->jumat_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->sabtu_mulai) && !empty($request->sabtu_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'sabtu';
                    $jam->mulai = $request->sabtu_mulai;
                    $jam->berakhir = $request->sabtu_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                if(!empty($request->minggu_mulai) && !empty($request->minggu_akhir)) {
                    $jam = new Jam();
                    $jam->hari = 'minggu';
                    $jam->mulai = $request->minggu_mulai;
                    $jam->berakhir = $request->minggu_akhir;
                    $jam->id_konten = $data->id_konten;
                    $jam->save();
                }

                toastr()->success('Berhasil menyimpan data');
                return redirect(route('konten.index'));
            } catch (\Throwable $th) {
                return $th->getMessage();
                toastr()->error('Gagal menympan data');
                return back();
            }
        }else{
            toastr()->error('Mohon upload gambar terlebih dahulu');
            return back();
        }

    }

    public function edit($id) {
        $konten = Konten::findOrFail($id);
        $koleksi = Koleksi::orderBy('nama_koleksi', 'asc')->get();

        $senin = Jam::where('id_konten', $id)
        ->where('hari', 'senin')
        ->first();

        $selasa = Jam::where('id_konten', $id)
        ->where('hari', 'selasa')
        ->first();

        $rabu = Jam::where('id_konten', $id)
        ->where('hari', 'rabu')
        ->first();

        $kamis = Jam::where('id_konten', $id)
        ->where('hari', 'kamis')
        ->first();

        $jumat = Jam::where('id_konten', $id)
        ->where('hari', 'jumat')
        ->first();

        $sabtu = Jam::where('id_konten', $id)
        ->where('hari', 'sabtu')
        ->first();

        $minggu = Jam::where('id_konten', $id)
        ->where('hari', 'minggu')
        ->first();
        

        return view('konten.edit', compact([
            'koleksi',
            'konten',
            'senin',
            'selasa',
            'rabu',
            'kamis',
            'jumat',
            'sabtu',
            'minggu'
        ]));
    }

    public function ubahJam(Request $request, $id) {
        $konten = Konten::findOrFail($id);

        $jam = Jam::where('hari', $request->hari)
        ->where('id_konten', $konten->id_konten)
        ->first();

        if($jam) {
            $jam->mulai = $request->mulai;
            $jam->berakhir = $request->berakhir;
            $jam->save();
            toastr()->success('Berhasil');
            return back();
        }else{
            $jam = new Jam();
            $jam->id_konten = $konten->id_konten;
            $jam->hari = $request->hari;
            $jam->mulai = $request->mulai;
            $jam->berakhir = $request->berakhir;
            $jam->save();
            toastr()->success('Berhasil');
            return back();
        }
    }

    public function hapusJam(Request $request, $id) {
        $konten = Konten::findOrFail($id);
        
        $jam = Jam::where('hari', $request->hari)
        ->where('id_konten', $konten->id_konten)
        ->first();

        if($jam) {
            $jam->delete();
        }

        toastr()->success('Berhasil');
        return back();
    }

    public function update(Request $request, $id) {
        $data = Konten::findOrFail($id);
        $youtube = $this->getYoutubeId($request->video_youtube);

        if($youtube == null) {
            toastr()->error('Link youtube tidak valid');
            return back();
        }

        if($request->hasFile('gambar')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('gambar')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            $filenameToStore = rand() . time() . '.' . $ext;

            if(file_exists(public_path('uploads/gambar/'. $data->gambar))) {
                File::delete(public_path('uploads/gambar/'. $data->gambar));
            }

            $request->file('gambar')->move(public_path('uploads/gambar'), $filenameToStore);
            $data->gambar = $filenameToStore;
        }

        $data->nama = $request->nama;
        $data->id_koleksi = $request->id_koleksi;
        $data->video_youtube = $youtube;
        $data->kontak = $request->kontak;
        $data->lat_long = $request->lat_long;
        $data->narasi = $request->narasi;

        try {
            $data->save();
            toastr()->success('Berhasil menyimpan data');
            return redirect(route('konten.index'));
        } catch (\Throwable $th) {
            return $th->getMessage();
            toastr()->error('Gagal menympan data');
            return back();
        }
    }

    public function destroy($id) {
        $data = Konten::findOrFail($id);

        try {
            Jam::where('id_konten', $data->id_konten)->delete();
            Review::where('id_konten', $data->id_konten)->delete();

            $gambar = $data->gambar;
            $data->delete();

            if(file_exists(public_path('uploads/gambar/'. $gambar))) {
                File::delete(public_path('uploads/gambar/'. $gambar));
            }

            toastr()->success('Berhasil');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Gagal');
            return back();
        }

    }
}
