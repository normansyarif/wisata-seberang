@extends('layouts.main')

@section('title', 'Atur Role Pengguna')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Role Pengguna</h5>
            <p class="card-category">Role {{ $user->name }} di aplikasi</p>
        </div>
        <form class="card-body" method="post" action="{{ route('user.role.sync', encrypt($user->id)) }}}">
            @csrf
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th style="width: 20%">Punya akses?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $i => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                            @foreach($role->permissions as $permission)
                                <div class="badge badge-info">{{ $permission->display_name }}</div><br>
                            @endforeach
                        </td>
                        <td>
                            <input name="roles[]" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }} type="checkbox" class="form-control">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="col">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

    <script>
    </script>

@endsection
