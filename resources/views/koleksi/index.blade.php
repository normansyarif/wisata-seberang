@extends('layouts.main')

@section('title', 'Atur Koleksi')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Koleksi</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('koleksi.create') }}" class="float-right btn btn-primary" >
                Tambah Koleksi
            </a>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th colspan="2">Nama Koleksi</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($koleksi as $i => $k)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td style="width: 10%">
                                <img src="{{ url('icons/' . $k->icon) }}" style="width: 100%" alt="">
                            </td>
                            <td>{{ $k->nama_koleksi }}</td>
                            <td>
                                <a href="{{ route('koleksi.edit', encrypt($k->id_koleksi)) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button onclick="
                                if(confirm('Anda yakin?')) {
                                    $(this).find('form').submit();
                                }
                                " class="btn btn-sm btn-danger">
                                    <form action="{{ route('koleksi.destroy', encrypt($k->id_koleksi)) }}" method="post">
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
@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

    <script>
    </script>

@endsection
