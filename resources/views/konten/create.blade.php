@extends('layouts.main')

@section('title', 'Tambah Konten')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Konten</h5>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('konten.store') }}" class="card-body">
            @csrf
            <div class="mb-3">
                <label for="">Nama</label>
                <input name="nama" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Jenis Koleksi</label>
                <select name="id_koleksi" class="form-control" id="" required>
                    <option value="">-- Pilih jenis koleksi --</option>
                    @foreach($koleksi as $item)
                    <option value="{{ $item->id_koleksi }}">{{ $item->nama_koleksi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Gambar</label>
                <input name="gambar" type="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Video YouTube</label>
                <input name="video_youtube" type="text" class="form-control">
                <span class="text-muted" style="font-size: .8em; font-style:italic">Contoh <span class="text-danger">https://www.youtube.com/watch?v=UWYPTui1wCc</span></span>
            </div>
            <div class="mb-3">
                <label for="">Kontak</label>
                <input name="kontak" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Lokasi (latitude, longitude)</label>
                <input name="lat_long" type="text" class="form-control" required>
                <span class="text-muted" style="font-size: .8em; font-style:italic">Contoh <span class="text-danger">-1.6100891,103.5185842</span></span>
            </div>
            <div class="mb-3">
                <label for="">Narasi</label>
                <textarea name="narasi" class="form-control" required id="" style="max-height: 300px" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="">Jam Operasional</label>
                <table class="table table-striped">
                    <tr>
                        <th>Hari</th>
                        <th>Waktu Mulai *</th>
                        <th>Waktu Berakhir *</th>
                    </tr>
                    <tr>
                        <td>Senin</td>
                        <td>
                            <input type="time" class="form-control" name="senin_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="senin_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td>Selasa</td>
                        <td>
                            <input type="time" class="form-control" name="selasa_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="selasa_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td>Rabu</td>
                        <td>
                            <input type="time" class="form-control" name="rabu_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="rabu_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td>Kamis</td>
                        <td>
                            <input type="time" class="form-control" name="kamis_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="kamis_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td>Jumat</td>
                        <td>
                            <input type="time" class="form-control" name="jumat_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="jumat_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-danger">Sabtu</td>
                        <td>
                            <input type="time" class="form-control" name="sabtu_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="sabtu_akhir">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-danger">Minggu</td>
                        <td>
                            <input type="time" class="form-control" name="minggu_mulai">
                        </td>
                        <td>
                            <input type="time" class="form-control" name="minggu_akhir">
                        </td>
                    </tr>
                </table>
                <span style="font-size: .85em; text-style:italic" class="text-muted">* Kosongkan jika hari libur</span>
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
