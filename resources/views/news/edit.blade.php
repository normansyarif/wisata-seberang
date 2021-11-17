@extends('layouts.main')

@section('title', 'Edit Berita')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Berita</h5>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('news.update', encrypt($news->id)) }}" class="card-body">
            @csrf
            <div class="mb-3">
                <label for="">Judul</label>
                <input value="{{ $news->title }}" name="title" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Gambar</label>
                <input name="image" type="file" class="form-control">
                <img class="mt-2" src="{{ url('news/' . $news->image) }}" alt="" style="width: 100px">
            </div>

            <div class="mb-3">
                <label for="">Waktu</label>
                <input name="date" value="{{ date('Y-m-d\TH:i', strtotime($news->date)) }}" type="datetime-local" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Lokasi</label>
                <input name="location" value="{{ $news->location }}" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Berita</label>
                <textarea id="" cols="30" rows="10" class="form-control" name="content" required>{{ $news->content }}</textarea>
            </div>

            <div class="col mb-3">
                <div class="text-center">
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('modals')
@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

    <script>
    </script>

@endsection
