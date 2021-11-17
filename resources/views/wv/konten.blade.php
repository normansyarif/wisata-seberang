<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/wv/index.css') }}">
</head>

<body style="background-color: #C8EAD7;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="padding: 0">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" >
                        @foreach($carousel as $key => $item)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="{{ url('uploads/gambar/' . $item->gambar) }}" alt="First slide">
                            <div class="carousel-caption">
                                <h5>{{ $item->nama }}</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="list mt-4">
                    <div class="container">
                        <div class="row">
                            @foreach($data as $item)
                            <div class="col-4" style="margin-bottom: 20px">
                                <a href="{{ route('wv.wisata', $item->id_konten) }}" style="margin: 0 auto; display: block; color: black" class="item-box">
                                    <div class="box-img" style="height: 70px; overflow: hidden;">
                                        <img src="{{ url('uploads/gambar/' . $item->gambar) }}" style="width: 100%; border-radius: 5px;" alt="">
                                    </div>
                                    <div class="box-text">
                                        <p>{{ $item->nama }}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

</body>

</html>