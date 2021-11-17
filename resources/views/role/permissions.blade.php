@extends('layouts.main')

@section('title', 'Atur Role')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Role - Permission</h5>
            <p class="card-category">Hak akses yang dimiliki role {{ $role->display_name }}</p>
        </div>
        <form class="card-body" method="post" action="{{ route('role.permissions.sync', encrypt($role->id)) }}">
            @csrf
            <div class="row">
                @foreach($permissions as $permission)
                <div class="col-md-3 col-6">
                    <input style="margin-top: 15px; margin-bottom: 15px" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}> {{ $permission->display_name }}
                </div>
                @endforeach
            </div>
            <div class="col">
                <div class="text-center">
                    <button style="margin-top: 10px" type="submit" class="btn btn-primary">Simpan</button>
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
