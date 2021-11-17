@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        @foreach ($koleksi as $item)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <img src="{{ url('icons/' . $item->icon) }}" alt="">
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">{{ $item->nama_koleksi }}</p>
                                    <p class="card-title">{{ count($item->konten) }}</p>
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('modals')
@endsection

@section('javascript')
    @include('plugins.select2')
    @include('plugins.datatables')

@endsection
