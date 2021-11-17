<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/wv/index.css') }}">
    <style>
        .rating {
            color: black;
        }
        .rating:hover {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="padding: 0">
                
                <div class="detail-head">
                </div>

                <div class="detail-img" style="width: 80%; margin: 0 auto">
                    <img src="{{ url('uploads/gambar/' . $data->gambar) }}" style="width: 100%" alt="">
                </div>

                <div style="position:relative; top: -30px">
                    <div class="container">
                        <p style="font-weight: bold; font-size: 1.3em; float: left; margin-right: 15px">{{ $data->nama }}</p>
                        <a class="rating" href="{{ route('wv.rating', $data->id_konten) }}" style="display: block;border: 1px solid gray; float: left; border-radius: 7px; padding: 3px 7px; cursor: pointer">
                            @if($ratingCount > 0)
                                <img src="{{ url('assets/star.svg') }}" style="width: 15px" alt="">
                                <span style="font-weight: bold;">{{ $ratingCount }}</span>
                                <span style="color: #333; font-size: .9em">({{ $ratingUsers }})</span>
                            @else
                                <span style="font-size: .85em; color: grey">Klik untuk memberi rating</span>
                            @endif
                        </a>
                        <div style="clear: both"></div>

                        <div style="margin-bottom: 15px; margin-top: 10px; cursor:pointer" id="location-btn">
                            <img src="{{ url('assets/marker.svg') }}" style="width: 15px" alt="">
                            <span style="color: #C0392B; font-size: .9em">Klik untuk menuju lokasi</span>
                        </div>

                    </div>
                </div>

                <div style="position:relative; top: -30px">
                    <div class="container" style="font-size: .9em;">
                        <p>{{ $data->narasi }}</p>
                    </div>
                </div>

                <div style="position: relative; top: -30px">
                    <div class="container">
                        @if($data->video_youtube != null)
                            <iframe style="width: 100%" height="250" src="https://www.youtube.com/embed/{{ $data->video_youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    </div>
                </div>

                <div style="position:relative; top: -10px">
                    <div class="container">
                        <label for="" style="font-weight: bold; font-style:italic;">Jam Operasional</label>
                        <table style="width: 100%;">
                            <tr style="font-weight: {{ date('l', time()) == 'Monday' ? 'bold' : 'normal' }}">
                                <td>Senin</td>
                                <td style="text-align: right;">
                                    @if($senin)
                                    {{ date('H:i', strtotime($senin->mulai)) }} - {{ date('H:i', strtotime($senin->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Tuesday' ? 'bold' : 'normal' }}">
                                <td>Selasa</td>
                                <td style="text-align: right;">
                                    @if($selasa)
                                    {{ date('H:i', strtotime($selasa->mulai)) }} - {{ date('H:i', strtotime($selasa->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Wednesday' ? 'bold' : 'normal' }}">
                                <td>Rabu</td>
                                <td style="text-align: right;">
                                    @if($rabu)
                                    {{ date('H:i', strtotime($rabu->mulai)) }} - {{ date('H:i', strtotime($rabu->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Thursday' ? 'bold' : 'normal' }}">
                                <td>Kamis</td>
                                <td style="text-align: right;">
                                    @if($kamis)
                                    {{ date('H:i', strtotime($kamis->mulai)) }} - {{ date('H:i', strtotime($kamis->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Friday' ? 'bold' : 'normal' }}">
                                <td>Jumat</td>
                                <td style="text-align: right;">
                                    @if($jumat)
                                    {{ date('H:i', strtotime($jumat->mulai)) }} - {{ date('H:i', strtotime($jumat->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Saturday' ? 'bold' : 'normal' }}">
                                <td>Sabtu</td>
                                <td style="text-align: right;">
                                    @if($sabtu)
                                    {{ date('H:i', strtotime($sabtu->mulai)) }} - {{ date('H:i', strtotime($sabtu->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr style="font-weight: {{ date('l', time()) == 'Sunday' ? 'bold' : 'normal' }}">
                                <td>Minggu</td>
                                <td style="text-align: right;">
                                    @if($minggu)
                                    {{ date('H:i', strtotime($minggu->mulai)) }} - {{ date('H:i', strtotime($minggu->berakhir)) }}
                                    @else
                                    <span style="color: red">Libur</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div style="position:relative; top: 10px">
                    <div class="container">
                        <table style="width: 100%;">
                            <tr>
                                <td style="font-weight: bold; font-style:italic;">Kontak</td>
                                <td style="text-align: right;">{{ $data->kontak }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div style="margin-bottom: 50px;"></div>
                
    
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script>
        $('#location-btn').click(function() {
            let location = '{{ $data->lat_long }}';
            location = "https://www.google.com/maps/search/" + location;
            let data = '{"status": "ok", "location": "' + location + '"}';
            alert(data);
        })
    </script>
    
</body>
</html>