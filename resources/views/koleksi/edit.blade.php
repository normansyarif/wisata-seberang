@extends('layouts.main')

@section('title', 'Tambah Koleksi')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Koleksi</h5>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('koleksi.update', encrypt($koleksi->id_koleksi)) }}" class="card-body">
            @csrf
            <div class="mb-3">
                <label for="">Nama Koleksi</label>
                <input value="{{ $koleksi->nama_koleksi }}" name="nama_koleksi" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Icon</label>
                <input name="icon" type="file" class="form-control">
                <img class="mt-2" src="{{ url('icons/' . $koleksi->icon) }}" alt="" style="width: 100px">
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
