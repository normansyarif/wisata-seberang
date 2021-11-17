<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index() {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('news'));
    }

    public function create() {
        return view('news.create');
    }

    public function store(Request $request) {
        if($request->hasFile('image')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('image')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            $filenameToStore = rand() . time() . '.' . $ext;
            $request->file('image')->move(public_path('news'), $filenameToStore);
            
            $news = new News();
            $news->title = $request->title;
            $news->content = $request->content;
            $news->location = $request->location;
            $news->date = $request->date;
            $news->image = $filenameToStore;
            $news->save();
            toastr()->success('Berhasil menambah data');
            return redirect(route('news.index'));
        }else{
            toastr()->error('Mohon upload gambar terlebih dahulu');
            return back();
        }
    }

    public function edit($id) {
        $news = News::findOrFail(decrypt($id));
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, $id) {
        $news = News::findOrFail(decrypt($id));
        $news->title = $request->title;
        $news->content = $request->content;
        $news->location = $request->location;
        $news->date = $request->date;

        if($request->hasFile('image')) {
            $allowed = ['jpg', 'jpeg', 'png'];

            $ext = $request->file('image')->getClientOriginalExtension();
            if (!in_array($ext, $allowed)) {
                toastr()->error('Format tidak didukung');
                return back();
            }

            if(file_exists(public_path('news/' . $news->image))) {
                File::delete(public_path('news/' . $news->image));
            }

            $filenameToStore = rand() . time() . '.' . $ext;
            $request->file('image')->move(public_path('news'), $filenameToStore);
            $news->image = $filenameToStore;
        }

        $news->save();
        toastr()->success('Berhasil mengubah data');
        return back();
    }

    public function destroy($id) {
        $news = News::findOrFail(decrypt($id));

        try {
            $image = $news->image;
            $news->delete();
            
            if(file_exists(public_path('news/' . $image))) {
                File::delete(public_path('news/' . $image));
            }

            toastr()->success('Berhasil menghapus data');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Gagal menghapus');
            return back();
        }
    }
}
