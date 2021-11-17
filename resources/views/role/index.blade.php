@extends('layouts.main')

@section('title', 'Atur Role')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Role</h5>
            <p class="card-category">Atur role pengguna</p>
        </div>
        <div class="card-body">
            <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#createModal">
                Tambah Role
              </button>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $i => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <div class="badge badge-info">{{ $permission->display_name }}</div><br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('role.permissions', encrypt($role->id)) }}"
                                    class="btn btn-sm btn-primary mb-3">Atur Permission</a>
                                <button onclick="
                                if(confirm('Anda yakin?')) {
                                    $(this).find('form').submit();
                                }
                                " class="mb-3 btn btn-sm btn-danger">
                                    <form action="{{ route('role.destroy', encrypt($role->id)) }}" method="post">
                                        @csrf
                                    </form>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('modals')
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('role.store') }}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama Role</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Display Name</label>
                        <input type="text" class="form-control" name="display_name" required>
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
