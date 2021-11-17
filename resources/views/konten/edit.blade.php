@extends('layouts.main')

@section('title', 'Edit Konten')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Konten</h5>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ route('konten.update', $konten->id_konten) }}" class="card-body">
            @csrf
            <div class="mb-3">
                <label for="">Nama</label>
                <input value="{{ $konten->nama }}" name="nama" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Jenis Koleksi</label>
                <select name="id_koleksi" class="form-control" id="" required>
                    <option value="">-- Pilih jenis koleksi --</option>
                    @foreach($koleksi as $item)
                    <option {{ ($konten->id_koleksi == $item->id_koleksi) ? 'selected' : '' }} value="{{ $item->id_koleksi }}">{{ $item->nama_koleksi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Gambar</label>
                <input name="gambar" type="file" class="form-control">
                
                @if($konten->gambar != null)
                <img class="mt-3" src="{{ url('uploads/gambar/' . $konten->gambar) }}" style="width: 300px" alt="">
                @endif
                
            </div>
            <div class="mb-3">
                <label for="">Video YouTube</label>
                <input value="{{ $konten->video_youtube != null ? 'https://www.youtube.com/watch?v=' . $konten->video_youtube : '' }}" name="video_youtube" type="text" class="form-control" required>
                <span class="text-muted" style="font-size: .8em; font-style:italic">Contoh <span class="text-danger">https://www.youtube.com/watch?v=UWYPTui1wCc</span></span>
                
                @if($konten->video_youtube != null)
                <br>
                <iframe class="mt-3" width="400" height="200" src="https://www.youtube.com/embed/{{ $konten->video_youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
            </div>
            <div class="mb-3">
                <label for="">Kontak</label>
                <input value="{{ $konten->kontak }}" name="kontak" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Lokasi (latitude, longitude)</label>
                <input value="{{ $konten->lat_long }}" name="lat_long" type="text" class="form-control" required>
                <span class="text-muted" style="font-size: .8em; font-style:italic">Contoh <span class="text-danger">-1.6100891,103.5185842</span></span>
            </div>
            <div class="mb-3">
                <label for="">Narasi</label>
                <textarea name="narasi" class="form-control" required id="" style="max-height: 300px" cols="30" rows="10">{{ $konten->narasi }}</textarea>
            </div>
            <div class="mb-3">
                <label for="">Jam Operasional</label>
                <table class="table table-striped">
                    <tr>
                        <th>Hari</th>
                        <th>Jam Operasional</th>
                    </tr>
                    <tr>
                        <td>Senin</td>
                        <td>
                            @if(isset($senin->mulai) && isset($senin->berakhir))
                                {{ date('H:i', strtotime($senin->mulai)) }} - {{ date('H:i', strtotime($senin->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $senin->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $senin->berakhir ?? null }}');
                            $('#hari').val('senin');
                            $('#hari_hapus').val('senin');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Selasa</td>
                        <td>
                            @if(isset($selasa->mulai) && isset($selasa->berakhir))
                                {{ date('H:i', strtotime($selasa->mulai)) }} - {{ date('H:i', strtotime($selasa->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $selasa->mulai  ?? null }}');
                            $('#jam_akhir').val('{{ $selasa->berakhir ?? null }}');
                            $('#hari').val('selasa');
                            $('#hari_hapus').val('selasa');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Rabu</td>
                        <td>
                            @if(isset($rabu->mulai) && isset($rabu->berakhir))
                                {{ date('H:i', strtotime($rabu->mulai)) }} - {{ date('H:i', strtotime($rabu->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $rabu->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $rabu->berakhir ?? null }}');
                            $('#hari').val('rabu');
                            $('#hari_hapus').val('rabu');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Kamis</td>
                        <td>
                            @if(isset($kamis->mulai) && isset($kamis->berakhir))
                                {{ date('H:i', strtotime($kamis->mulai)) }} - {{ date('H:i', strtotime($kamis->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $kamis->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $kamis->berakhir ?? null }}');
                            $('#hari').val('kamis');
                            $('#hari_hapus').val('kamis');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumat</td>
                        <td>
                            @if(isset($jumat->mulai) && isset($jumat->berakhir))
                                {{ date('H:i', strtotime($jumat->mulai)) }} - {{ date('H:i', strtotime($jumat->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $jumat->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $jumat->berakhir ?? null }}');
                            $('#hari').val('jumat');
                            $('#hari_hapus').val('jumat');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-danger">Sabtu</td>
                        <td>
                            @if(isset($sabtu->mulai) && isset($sabtu->berakhir))
                                {{ date('H:i', strtotime($sabtu->mulai)) }} - {{ date('H:i', strtotime($sabtu->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $sabtu->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $sabtu->berakhir ?? null }}');
                            $('#hari').val('sabtu');
                            $('#hari_hapus').val('sabtu');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-danger">Minggu</td>
                        <td>
                            @if(isset($minggu->mulai) && isset($minggu->berakhir))
                                {{ date('H:i', strtotime($minggu->mulai)) }} - {{ date('H:i', strtotime($minggu->berakhir)) }}
                            @else
                                <span class="text-danger">Libur</span>
                            @endif
                            <br>
                            <a onclick="
                            $('#form_ubah').attr('action', '{{ route('konten.ubah-jam', $konten->id_konten) }}');
                            $('#form_hapus').attr('action', '{{ route('konten.hapus-jam', $konten->id_konten) }}');
                            $('#jam_mulai').val('{{ $minggu->mulai ?? null }}');
                            $('#jam_akhir').val('{{ $minggu->berakhir ?? null }}');
                            $('#hari').val('minggu');
                            $('#hari_hapus').val('minggu');
                            $('#editJamModal').modal('show');
                            " class="mt-2" style="font-size: .85em; text-decoration:underline" href="javascript:void(0)">Ubah Waktu</a>
                        </td>
                    </tr>
                </table>
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
<form style="display: none" action="" id="form_hapus" method="post">
    @csrf
    <input type="text" id="hari_hapus" name="hari" required>
</form>

<div class="modal fade" id="editJamModal" tabindex="-1" role="dialog" aria-labelledby="editJamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form_ubah" method="post" action="" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editJamModalLabel">Ubah Jam Operasional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hari" name="hari" required>
                    <div class="mb-3">
                        <label for="">Jam Mulai</label>
                        <input id="jam_mulai" name="mulai" type="time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jam Berakhir</label>
                        <input id="jam_akhir" name="berakhir" type="time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <a class="text-danger" href="javascript:void(0)" onclick="
                        if(confirm('Anda yakin?')) {
                            $('#form_hapus').submit();
                        }
                        ">Jadikan hari libur</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

    <script>
    </script>

@endsection
