@extends('layouts.main')

@section('title', 'Atur Berita')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Berita</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('news.create') }}" class="float-right btn btn-primary" >
                Tambah Berita
            </a>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th colspan="2">Judul Berita</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $i => $k)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td style="width: 10%">
                                <img src="{{ url('news/' . $k->image) }}" style="width: 100%" alt="">
                            </td>
                            <td>{{ $k->title }}</td>
                            <td>
                                <a href="{{ route('news.edit', encrypt($k->id)) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button onclick="
                                if(confirm('Anda yakin?')) {
                                    $(this).find('form').submit();
                                }
                                " class="btn btn-sm btn-danger">
                                    <form action="{{ route('news.destroy', encrypt($k->id)) }}" method="post">
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
