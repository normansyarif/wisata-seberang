@extends('layouts.main')

@section('title', 'Tambah Koleksi')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Koleksi</h5>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('koleksi.store') }}" class="card-body">
            @csrf
            <div class="mb-3">
                <label for="">Nama Koleksi</label>
                <input name="nama_koleksi" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Icon</label>
                <input name="icon" type="file" class="form-control" required>
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
