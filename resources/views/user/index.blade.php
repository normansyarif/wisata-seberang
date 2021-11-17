@extends('layouts.main')

@section('title', 'Atur Pengguna')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pengguna</h5>
            <p class="card-category">Daftar pengguna yang terdaftar di aplikasi</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        Tambah Pengguna
                      </button>
                </div>
                <div class="col-12">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Name</th>
                                <th>Role</th>
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
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ route('user.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="konfirmasi" required>
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
                    data: {},
                    url: "{{ url()->current() }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'name',
                        name: 'name',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'role',
                        name: 'role',
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
