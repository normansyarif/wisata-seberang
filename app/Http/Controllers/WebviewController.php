<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koleksi;
use App\Models\Konten;
use App\Models\News;
use App\Models\Jam;
use App\Models\Rating;

class WebviewController extends Controller
{
    public function index() {
        $menu = Koleksi::orderBy('nama_koleksi')->get();
        $news = News::orderBy('date', 'desc')->get();
        return view('wv.index', compact('menu', 'news'));
    }

    public function listKonten($id_koleksi) {
        $data = Konten::where('id_koleksi', $id_koleksi)->get();
        $carousel = Konten::where('id_koleksi', $id_koleksi)->orderBy('created_at', 'desc')->take(3)->get();
        return view('wv.konten', compact('data', 'carousel'));
    }

    public function detailInfo($id) {
        $data = News::findOrFail($id);
        return view('wv.detail-info', compact('data'));
    }

    public function detailWisata($id) {
        $data = Konten::findOrFail($id);

        $ratingCount = 0;
        $ratingUsers = 0;
        $rating = Rating::where('id_konten', $id);
        if($rating->count() > 0) {
            $ratingCount = round($rating->sum('rating') / $rating->count(), 1);
            $ratingUsers = $rating->count();
        }

        $senin = Jam::where('hari', 'senin')->where('id_konten', $id)->first();
        $selasa = Jam::where('hari', 'selasa')->where('id_konten', $id)->first();
        $rabu = Jam::where('hari', 'rabu')->where('id_konten', $id)->first();
        $kamis = Jam::where('hari', 'kamis')->where('id_konten', $id)->first();
        $jumat = Jam::where('hari', 'jumat')->where('id_konten', $id)->first();
        $sabtu = Jam::where('hari', 'sabtu')->where('id_konten', $id)->first();
        $minggu = Jam::where('hari', 'minggu')->where('id_konten', $id)->first();

        return view('wv.detail-wisata', compact('ratingCount', 'ratingUsers', 'data', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'));
    }

    public function rating($id) {
        $data = Konten::findOrFail($id);
        $ratings = Rating::where('id_konten', $id)->orderBy('created_at', 'desc')->get();
        return view('wv.rating', compact('ratings', 'data'));
    }

    public function ratingPost(Request $request, $id) {
        $rating = new Rating();
        $rating->nama = $request->nama;
        $rating->komentar = $request->komentar;
        $rating->rating = $request->rating;
        $rating->id_konten = $id;
        $rating->save();
        return redirect(route('wv.wisata', $id));
    }
}
