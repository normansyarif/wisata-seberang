<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/wv/index.css') }}">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="padding: 0">
                
                <div class="app-head">
                    <div>
                        <p style="font-size: 1.5em; font-weight: bold; font-family: 'Times New Roman', Times, serif">ELOK SEKOJA</p>
                        <p style="font-size: .85em; font-family: 'Times New Roman', Times, serif">Seberang Kota Jambi</p>
                    </div>
                </div>

                <div class="app-banner">
                    <img src="{{ asset('assets/wv/app-baner.jpeg') }}" style="width: 100%" alt="">
                </div>

                <div class="icon-wrapper row">
                    @foreach($menu as $item)
                    <div class="col-4" style="margin-bottom: 20px;">
                        <a href="{{ route('wv.konten', $item->id_koleksi) }}" style="text-align: center; display: block; color: black">
                            <img style="width: 50%; margin-bottom: 5px; border-radius: 5px" src="{{ url('icons/' . $item->icon) }}" alt="">
                            <p style="margin: 0; font-size: .9em">{{ $item->nama_koleksi }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="info-label">
                    <p>INFO WISASTA</p>
                </div>

                <div class="info-list">
                    <div class="container">
                        @foreach($news as $item)
                        <a href="{{ route('wv.info', $item->id) }}" style="display: block; color: black" class="info-item">
                            <div class="row">
                                <div class="col-3">
                                    <div class="info-thumb-container">
                                        <img src="{{ url('news/' . $item->image) }}" style="width: 100%" alt="">
                                    </div>
                                </div>
                                <div class="col-9 info-text">
                                    <p style="font-weight: bold;">{{ $item->title }}</p>
                                    <p style="font-size: .85em; font-style: italic;" class="text-muted">{{ date('d-m-Y', strtotime($item->date)) }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
</body>
</html>