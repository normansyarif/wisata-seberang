@extends('layouts.main')

@section('title', 'Atur Konten')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Konten</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('konten.create') }}" class="float-right btn btn-primary">
                        Tambah Konten
                    </a>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="">Pilih Jenis Koleksi</label>
                        <select name="id_koleksi" onchange="load_data()" id="koleksi" class="form-control">
                            <option value="">Semua</option>
                            @foreach ($koleksi as $item)
                                <option value="{{ $item->id_koleksi }}">{{ $item->nama_koleksi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 10%">Gambar</th>
                                <th>Nama</th>
                                <th>Jenis Koleksi</th>
                                <th style="width: 20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')
@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

    <script>
        load_data();

        function load_data() {
            var table = $('#table').DataTable({
                bAutoWidth: false,
                bLengthChange: true,
                iDisplayLength: 20,
                searching: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                bStateSave: true,
                ajax: {
                    data: {
                        id_koleksi: $("select[name='id_koleksi']").val(),
                    },
                    url: "{{ url()->current() }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'koleksi',
                        name: 'koleksi',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }

                ],
                aLengthMenu: [
                    [10, 15, 25, 35, 50, 100, -1],
                    [10, 15, 25, 35, 50, 100, "All"]
                ],
                responsive: !0,
                drawCallback: function() {
                    this.api().state.clear();
                }
            });
        }
    </script>

@endsection
